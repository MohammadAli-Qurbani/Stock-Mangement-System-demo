<?php
namespace App\Services\Stock;

use App\Models\Stock;

class StockServices{
    public function index($dragSearch=null){
        return Stock::
        when($dragSearch,function($query)use($dragSearch){
            $query->where('drag_name','like',"%{$dragSearch}%");
        })->with(['drag_rates','category'])->latest('id')->where('quantity','!=',0)->get();
    }
}
