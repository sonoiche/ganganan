<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Client\JobApplication;

class ApplicantChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.charts.applicant.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $month = '';
        $data['data'] = $this->getMonthlyApplicantCount($month);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $month = $request['month'];
        $data['data'] = $this->getMonthlyApplicantCount($month);

        return response()->json($data);
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
        //
    }

    private function getMonthlyApplicantCount($month)
    {
        $label      = [];
        $applied    = [];
        $hired      = [];

        if($month) {
            $dailyApplicantCounts = JobApplication::select(
                    DB::raw('DAY(created_at) as day'),
                    DB::raw('SUM(CASE WHEN status = "Applied" THEN status ELSE 0 END) as total_applied_count'),
                    DB::raw('SUM(CASE WHEN status = "Hired" THEN status ELSE 0 END) as total_hired_count')
                )
                ->whereRaw("month(created_at) = ?", [$month])
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            foreach ($dailyApplicantCounts as $dailyData) {
                $label[]    = $month.'/' . str_pad($dailyData->day, 2, '0', STR_PAD_LEFT);
                $applied[]  = $dailyData->total_applied_count;
                $hired[]    = $dailyData->total_hired_count;
            }

            return [$label, $applied, $hired];
        }

        $monthlyApplicantCounts = JobApplication::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(CASE WHEN status = "Applied" THEN status ELSE 0 END) as total_applied_count'),
                DB::raw('SUM(CASE WHEN status = "Hired" THEN status ELSE 0 END) as total_hired_count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        foreach ($monthlyApplicantCounts as $monthlyData) {
            $monthNames = [
                1  => 'January',
                2  => 'February',
                3  => 'March',
                4  => 'April',
                5  => 'May',
                6  => 'June',
                7  => 'July',
                8  => 'August',
                9  => 'September',
                10 => 'October',
                11 => 'November',
                12 => 'December',
            ];
            $label[]    = $monthNames[$monthlyData->month];
            $applied[]  = $monthlyData->total_applied_count;
            $hired[]    = $monthlyData->total_hired_count;
        }

        return [$label, $applied, $hired];
    }
}
