<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use ZipArchive;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client\Identification;

class VerifyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::where('status', 'Inactive')
            ->where('role', 'User')
            ->withCount('identifications')
            ->latest()
            ->get();

        return view('admin.user-verified.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id    = $request['id'];
        $user       = User::find($user_id);
        $user->status = $request['status'];
        $user->save();

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(200);
    }

    public function downloadIdentifications(string $id)
    {
        $user = User::findOrFail($id);
        $identifications = Identification::where('user_id', $user->id)->get();

        if ($identifications->isEmpty()) {
            return redirect()->back()->with('error', 'This user has not uploaded any identification files yet.');
        }

        if ($identifications->count() === 1) {
            $file = $identifications->first();
            $contents = $this->fetchRemoteFile($file->file_url);

            if ($contents === null) {
                return redirect()->back()->with('error', 'We could not retrieve the identification file. Please try again later.');
            }

            $filename = $this->generateFilenameFromUrl($file->file_url, 'identification-' . $user->id);

            return response()->streamDownload(function () use ($contents) {
                echo $contents;
            }, $filename);
        }

        $tempDirectory = storage_path('app/tmp');
        if (!is_dir($tempDirectory)) {
            mkdir($tempDirectory, 0755, true);
        }

        $zipFileName = 'identifications-' . $user->id . '-' . now()->format('YmdHis') . '.zip';
        $zipFilePath = $tempDirectory . '/' . $zipFileName;

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return redirect()->back()->with('error', 'Unable to generate the identification archive. Please try again.');
        }

        $addedFiles = 0;
        foreach ($identifications as $index => $identification) {
            $contents = $this->fetchRemoteFile($identification->file_url);
            if ($contents === null) {
                continue;
            }

            $filename = $this->generateFilenameFromUrl(
                $identification->file_url,
                'identification-' . ($index + 1)
            );

            $zip->addFromString($filename, $contents);
            $addedFiles++;
        }

        $zip->close();

        if ($addedFiles === 0 || !file_exists($zipFilePath)) {
            if (file_exists($zipFilePath)) {
                unlink($zipFilePath);
            }

            return redirect()->back()->with('error', 'We could not retrieve any identification files to download.');
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    protected function fetchRemoteFile(string $url): ?string
    {
        try {
            $response = Http::timeout(15)->get($url);
            if ($response->successful()) {
                return $response->body();
            }
        } catch (\Throwable $th) {
            return null;
        }

        return null;
    }

    protected function generateFilenameFromUrl(string $url, string $fallbackName): string
    {
        $path = parse_url($url, PHP_URL_PATH);
        $basename = $path ? basename($path) : null;

        if ($basename) {
            return $basename;
        }

        return Str::slug($fallbackName) . '.file';
    }
}
