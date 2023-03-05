<?php

namespace App\Services\Sell;

use App\Models\Sell;
use App\Models\Stock;

class SellServices
{
    public function index()
    {
        return Sell::with('stock')->latest('id')->get();
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
