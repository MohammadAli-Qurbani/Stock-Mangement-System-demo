<?php

namespace App\Services\Sell;

use App\Models\Sell;
use App\Models\Stock;

class SellServices
{
    public function index(string $searchPram=null)
    {
        return Sell::when($searchPram,function($sell)use($searchPram){
            $sell->where(function($query)use($searchPram){
                $query->whereDate('created_at','like',"%{$searchPram}%")
                ->orWhereHas('stock',function($stock)use($searchPram){
                    $stock->where('drag_name','like',"%{$searchPram}%");
                });
            });
        })
        ->with('stock')->latest('id')->get();
    }

    public function store(array $data)
    {

        foreach ($data as $key => $value) {
            foreach ($value as $key => $val) {
                Sell::create($val);
               $stock= Stock::findOrFail($val['stock_id']);
               $stock->update(['quantity'=>$stock->quantity-$val['quantity']]);
            }
        }
    }
}
