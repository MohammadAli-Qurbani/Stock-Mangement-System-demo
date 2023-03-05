<?php

namespace App\Http\Controllers;

use App\Http\Resources\Report\Good\GoodMonthlyReportResource;
use App\Http\Resources\Report\Good\GoodYearlyReportResource;
use App\Http\Resources\Report\GoodDaliyReportReSource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoodReportController extends Controller
{

    public function index()
    {
        return view('reports.good.index');
    }

    public function yearlyChart(){
        return view('reports.good.yearly');

    }
    public function chart(){
        return view('reports.good.chart');
    }
    public function daily()
    {
        // total bougth drags, total amount, exact date

        $dailyGoodReport = DB::table('goods')
            ->selectRaw('count(id) as id ,
                sum(total_price) as totalPrice,
                created_at'
            )

            ->whereDate('created_at', Carbon::now()->toDateString())
            ->get()
            ->toArray();
        return GoodDaliyReportReSource::collection($dailyGoodReport);
    }

    public function monthly(Request $request){
        // dd($request->all());
        $year=Carbon::now()->year;
        if(!empty($request->year)){
            $year=$request->year;
            // dd($year);
        }
        $monthlyReport=DB::table('goods')
         ->selectRaw('count(id) as total_drag,
            sum(total_price) as totalPrice,
            monthName(created_at) as month')
         ->groupByRaw('month')
         ->whereYear('created_at',$year)
         ->get()
        ->toArray();
        return GoodMonthlyReportResource::collection($monthlyReport);
    }

    public function yearly(Request $request){
        $year=Carbon::now()->year;
        if(!empty($request->year)){
            $year=$request->year;
        }
        $yearlyReport=DB::table('goods')
        ->selectRaw('sum(total_price) as totalPrice,
           year(created_at) as year')
        ->latest('year')
        ->groupByRaw('year')
        ->when($request->year,function($yearlyReport){
            $yearlyReport->whereYear('created_at',Carbon::now()->year);
        })
        ->get()
       ->toArray();
       return GoodYearlyReportResource::collection($yearlyReport);
    }
}
