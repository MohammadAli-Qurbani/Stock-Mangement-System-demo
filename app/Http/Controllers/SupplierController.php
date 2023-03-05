<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\SupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Http\Resources\Supplier\SupplierResource;
use App\Models\Supplier;
use App\Services\Supplier\SupplierServices;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // public function index()
    // {

    //     return view('supplier.index');
    // }

    public function getSuppliers(Request $request)
    {
        // dd("hi");
        // dd(request('searchParam'));
        // dd($request->all());
        $search=$request->searchParm;
        $suppliers=(new SupplierServices())->index($search,'paginate');
        return SupplierResource::collection($suppliers);
    }

    public function store(SupplierRequest $request)
    {
        $data = $request->validated();
        $supplier =(new SupplierServices())->store($data);
        return new SupplierResource($supplier);
    }

    public function edit(Supplier $supplier)
    {
        return new SupplierResource($supplier);
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $data = $request->validated();
        (new SupplierServices())->update($data,$supplier);
    }

    public function destroy(Supplier $supplier){
        return Supplier::whereNotIn('id',function($query){
            $query->select('supplier_id')->from('goods');
        })->whereId($supplier->id)->delete();
    }
}
