<?php

namespace App\Http\Controllers;

use App\Http\Resources\SellDailyReportResource;
use App\Http\Resources\SellReportResource;
use App\Http\Resources\SellYearlyReportResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellReportController extends Controller
{
    public function index(){
        return view('sells.report.index');
    }

    // public function yearlyChart(){
    //     return view('sells.report.yearly');
    // }

    // public function tableReport(){
    //     return view('sells.report.tableReport');
    // }

    public function daily(){
        $daily=DB::table('sells')
        ->selectRaw('sum(total_rate) as total_sell,created_at')
        ->whereDate('created_at',Carbon::now()->toDateString())
        ->get()->toArray();
        return SellDailyReportResource::collection($daily);
    }
    public function monthly(Request $request){
        $year=Carbon::now()->year;
        // dd($year);
        if(!empty($request->year)){
            $year=$request->year;
            // dd($year);
        }
        $monthlySell=DB::table('sells')
        ->selectRaw('monthName(created_at) as month ,
            sum(total_rate) as total_sell')
        ->groupByRaw('month')
        ->whereYear('created_at',$year)
        ->get()->toArray();
        return SellReportResource::collection($monthlySell);
    }
    public function yearly(Request $request){

        $yearlySell=DB::table('sells')
        ->selectRaw('year(created_at) as year, sum(total_rate) as total_sell')
        ->latest('year')
        ->when($request->year,function($sell)use($request){
            $sell->whereYear('created_at',$request->year);
        })
        ->groupByRaw('year')
        ->get()->toArray();
        return SellYearlyReportResource::collection($yearlySell);
    }


}
