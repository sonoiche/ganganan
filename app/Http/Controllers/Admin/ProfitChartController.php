<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Client\Payment;

class ProfitChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.charts.profit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $month = '';
        $data['data'] = $this->getMonthlyPaymentCount($month);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    private function getMonthlyPaymentCount($month)
    {
        $label  = [];
        $paid   = [];

        if($month) {
            $dailyPaymentCounts = Payment::select(
                    DB::raw('DAY(created_at) as day'),
                    DB::raw('SUM(amount) as total_count')
                )
                ->whereRaw("month(created_at) = ?", [$month])
                ->where('status', 'Paid')
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            foreach ($dailyPaymentCounts as $dailyData) {
                $label[]    = $month.'/' . str_pad($dailyData->day, 2, '0', STR_PAD_LEFT);
                $paid[]     = $dailyData->total_count;
            }

            return [$label, $paid];
        }

        $monthlyPaymentCounts = Payment::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total_count')
            )
            ->where('status', 'Paid')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        foreach ($monthlyPaymentCounts as $monthlyData) {
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
            $label[] = $monthNames[$monthlyData->month];
            $paid[]  = $monthlyData->total_count;
        }

        return [$label, $paid];
    }
}
