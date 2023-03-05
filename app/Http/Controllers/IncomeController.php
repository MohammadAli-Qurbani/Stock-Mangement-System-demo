<?php

namespace App\Http\Controllers;

use App\Http\Resources\Report\Good\GoodMonthlyReportResource;
use App\Http\Resources\Report\Good\GoodYearlyReportResource;
use App\Http\Resources\Report\GoodDaliyReportReSource;
use App\Http\Resources\SellReportResource;
use App\Http\Resources\SellYearlyReportResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    public function monthly()
    {
        return view('monthIncomeView.monthly');
    }

    public function yearly()
    {
        return view('yearIncomeView.yearly');
    }



    public function dailyIncome()
    {

        $year = Carbon::now()->toDateString();
        // return $year;
        $dailyReport = DB::table('goods')
            ->selectRaw('
            sum(total_price) as totalPrice,created_at')
            ->whereDate('created_at', $year)
            ->get()
            ->toArray();




        return response(
            [
                'goods' => GoodDaliyReportReSource::collection($dailyReport)
            ],
            Response::HTTP_OK
        );
    }
    public function monthlyIncome(Request $request)
    {

        $year = Carbon::now()->year;
        if (!empty($request->year)) {
            $year = $request->year;
            // dd($year);
        }
        $monthlyReport = DB::table('goods')
            ->selectRaw('count(id) as total_drag,
            sum(total_price) as totalPrice,
            monthName(created_at) as month')
            ->groupByRaw('month')
            ->whereYear('created_at', $year)
            ->get()
            ->toArray();


        $monthlySell = DB::table('sells')
            ->selectRaw('monthName(created_at) as month ,
            sum(total_rate) as total_sell')
            ->groupByRaw('month')
            ->whereYear('created_at', $year)
            ->get()->toArray();


        return response(
            [
                'goods' =>  GoodMonthlyReportResource::collection($monthlyReport),
                "selles" => SellReportResource::collection($monthlySell)
            ],
            Response::HTTP_OK
        );
    }

    public function yearlyIncome(Request $request)
    {
        $year = Carbon::now()->year;
        if (!empty($request->year)) {
            $year = $request->year;
        }

        $yearlyReport = DB::table('goods')
            ->selectRaw('sum(total_price) as totalPrice,
           year(created_at) as year')
            ->latest('year')
            ->groupByRaw('year')
            ->whereYear('created_at', $year)
            ->get()
            ->toArray();
        $goods = GoodYearlyReportResource::collection($yearlyReport);

        $yearlySell = DB::table('sells')
            ->selectRaw('year(created_at) as year, sum(total_rate) as total_sell')
            ->latest('year')
            ->whereYear('created_at', $year)
            ->groupByRaw('year')
            ->get()->toArray();
        $selles = SellYearlyReportResource::collection($yearlySell);
        return response(
            [
                'goods' => $goods,
                'selles' => $selles
            ],
            Response::HTTP_OK
        );
    }
}
