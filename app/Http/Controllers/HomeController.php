<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Client\Payment;
use Illuminate\Support\Facades\DB;
use App\Models\Client\JobApplication;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $monthNow   = Carbon::now()->format('m');
        $yearNow    = Carbon::now()->format('Y');

        $data['monthlyProfit']  = Payment::whereMonth('created_at', $monthNow)->whereYear('created_at', $yearNow)->sum('amount');
        $data['applicants']     = User::where('role', 'User')->count();
        $data['applications']   = JobApplication::where('status', 'Applied')->count();
        $data['hired']          = JobApplication::where('status', 'Hired')->count();

        $data['chart']          = $this->getMonthlyPaymentCount('');

        return view('home', $data);
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

        $monthNames = [
            1  => 'Jan',
            2  => 'Feb',
            3  => 'Mar',
            4  => 'Apr',
            5  => 'May',
            6  => 'Jun',
            7  => 'Jul',
            8  => 'Aug',
            9  => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec',
        ];

        $monthlyData = array_fill_keys(array_keys($monthNames), 0);

        foreach ($monthlyPaymentCounts as $monthlyDataItem) {
            $monthlyData[$monthlyDataItem->month] = $monthlyDataItem->total_count;
        }

        foreach ($monthlyData as $month => $totalCount) {
            $label[] = $monthNames[$month];
            $paid[]  = $totalCount;
        }

        return [$label, $paid];
    }
}
