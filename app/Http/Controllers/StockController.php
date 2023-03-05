<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowStockReource;
use App\Http\Resources\Stock\StockResource;
use App\Models\Stock;
use App\Models\Supplier;
use App\Services\Stock\StockServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('stock.index');
    // }

    public function getStocks(Request $request)
    {
        // return $request->all();
        $stcoks = resolve(StockServices::class)->index($request->dragSearch);
        return StockResource::collection($stcoks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        $stock = $stock->load(['drag_rateCompanies.good.supplier']);

        $info = DB::table('drag_rates')
            ->join('stocks', 'stocks.id', 'drag_rates.stock_id')
            ->join('goods', 'goods.id', 'drag_rates.good_id')
            ->join('suppliers', 'suppliers.id', 'goods.supplier_id')
            ->selectRaw('suppliers.company_name as company , suppliers.phone,suppliers.email,suppliers.city,suppliers.district')
            ->where('drag_rates.stock_id', $stock->id)
            ->groupByRaw('company')
            ->get()->toArray();
        // return view('stock.show', compact('stock', 'info'));
        return response(['stock'=>new StockResource($stock),'info'=>new ShowStockReource($info)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
