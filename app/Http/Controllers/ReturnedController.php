<?php

namespace App\Http\Controllers;

use App\Http\Resources\GetReturnedResource;
use App\Http\Resources\Good\GoodResource;
use App\Http\Resources\ReturnedResource;
use App\Models\DragRate;
use App\Models\Good;
use App\Models\Returned;
use App\Models\Stock;
use App\Services\Good\GoodServices;
use App\Services\ReturnGood\ReturnGoodServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ReturnedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('returned.index');
    }



    public function getGoods(Request $request)
    {

        return GoodResource::collection((new GoodServices())->index($request->searchParm));
    }

    public function retundedGood(Request $request)
    {
        return view('returned.indexGood');
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

       return (new ReturnGoodServices())->store($request);
    }

    public function getRetuneds(Request $request)
    {
        $returneds = (new ReturnGoodServices())->index($request->searchParm);
        return GetReturnedResource::collection($returneds);
    }



    // public function report()
    // {
    //     return view('returned.reportIndex');
    // }
}
