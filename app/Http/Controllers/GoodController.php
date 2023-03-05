<?php
namespace App\Http\Controllers;
use App\Http\Requests\Good\GoodRequest;
use App\Http\Resources\Good\GoodResource;
use App\Http\Resources\Supplier\SupplierResource;
use App\Models\Good;
use App\Services\Good\GoodServices;
use App\Services\Supplier\SupplierServices;
use Illuminate\Http\Request;
class GoodController extends Controller
{

    public function getSuppliers(Request $request)
    {
        // dd(request('searchParam'));
        // dd($request->all());
        $search=$request->searchParm;
        $suppliers=(new SupplierServices())->index($search,'get');
        return SupplierResource::collection($suppliers);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('goods.index');
    // }

    public function getGoods(){
        $searchParm=request('searchParm');
       $goods=resolve(GoodServices::class)->index($searchParm);
    //    dd($goods);
       return GoodResource::collection($goods);
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
    public function store(GoodRequest $request) {
        $data=$request->validated();
        // resolve(GoodServices::class)->store($data);
        (new GoodServices())->store($data);

        // return (new AccountService())->getPositions($this)
        // ->sortByDesc(fn (Position $position) => $position->totalPosition());
        // return response(['message'=>'success'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function show(Good $good){
        $good=$good->load('supplier','dragRate');
        return new GoodResource($good);
        // return view('goods.show',compact('good'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function edit(Good $good)
    {
         $good=$good->load(['supplier','dragRate','category']);
        return new GoodResource($good);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function update(GoodRequest $request, Good $good)
    {
        // return $good;
        $data=$request->validated();
      return  (new GoodServices())->update($data,$good);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function destroy(Good $good)
    {
        //
    }
}
