<?php

namespace App\Http\Controllers;

use App\Http\Resources\Expiration\ExpirationResource;
use App\Http\Resources\ExpirationDailyResource;
use App\Http\Resources\ExpirationMonthlyResource;
use App\Http\Resources\ExpirationYearlResource;
use App\Http\Resources\ExpiredGoodResource;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpirationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('expiration.index');
    // }

    public function expireAfterOnMonth()
    {
        $oneMonth = Carbon::now()->subDay()->addMonth()->format('Y-m-d');
        $expiration = Stock::with('drag_rates')->whereIn(
            'id',
            fn ($drag_rate) =>
            $drag_rate->select('stock_id')->from('drag_rates')
                ->where('expired_date', '=', $oneMonth)
        )
            ->where('quantity', '!=', 0)
            ->get();
        // drag name,quantity created_at
        return ExpirationMonthlyResource::collection($expiration);
    }

    public function expiringToDay()
    {
        $oneMonth = Carbon::now()->format('Y-m-d');
        // dd($oneMonth);
        $expiration = Stock::with('drag_rates')->whereIn('id', function ($drag_rate) use ($oneMonth) {
            $drag_rate->select('stock_id')->from('drag_rates')
                ->where('expired_date', '=', $oneMonth);
        })
            ->where('quantity', '!=', 0)
            ->get();
        return ExpirationDailyResource::collection($expiration);
    }

    // public function getExpirationView()
    // {
    //     return view('goodStockExpired.StockGoodExpired');
    // }

    public function getExpiration()
    {

        $expirations = Stock::with('drag_rates')->whereIn(
            'id',
            fn ($drag_rate) =>
            $drag_rate->select('stock_id')->from('drag_rates')
                ->where('expired_date', '<', Carbon::now())
        )
        ->where('quantity','!=',0)
            ->get();

        return ExpiredGoodResource::collection($expirations);
    }


    public function expireNextYear(Request $request)
    {
        $bty = null;
        // dd($request->all());
        $nextYear = Carbon::now()->subDay()->addYear()->toDateString();
        if ($request->filterByYear !== "null") {
            $nextYear = $request->filterByYear;
        }
        if ($request->firstYear !== "null") {
            $nextYear = null;
            $bty = $request->firstYear;
        }

        $expiration = Stock::with('drag_rates')
            ->whereIn('id', function ($drag_rate) use ($bty, $nextYear, $request) {
                $drag_rate->select('stock_id')->from('drag_rates')
                    ->when($nextYear, function ($query) use ($nextYear) {
                        $query->whereYear('expired_date', '=', $nextYear);
                    })
                    ->when($bty, function ($query) use ($request) {
                        $query->whereBetween('expired_date', [$request->firstYear, $request->secondYear]);
                    });
            })
            ->where('quantity', '!=', 0)
            ->get();
        return ExpirationYearlResource::collection($expiration);
    }
}
