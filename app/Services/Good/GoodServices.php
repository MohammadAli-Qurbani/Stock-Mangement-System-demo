<?php

namespace App\Services\Good;

use App\Models\DragRate;
use App\Models\Good;
use App\Models\Stock;

class GoodServices
{
    public function index(string|null $searchParm): object
    {
        $paginate = 10;
        if (!empty($searchParm)) {
            $paginate = 0;
        }
        return Good::with('category')
            ->when($searchParm, function ($query) use ($searchParm) {
                $query->where('drag_name', 'like', "%{$searchParm}%")
                    ->orWhereDate('created_at', 'like', "%{$searchParm}%");
            })->with(['supplier', 'category', 'dragRate'])
            ->latest('id')
            ->paginate($paginate);
    }

    //    fist i grap the name of good from stock
    //    second i check if name exists create a row in drag rate
    //    thrid check if the current buy sell rate exists with current stock id exists, if exists then come and update the quantity of stock with the current stock id
    // fourth if the current by sell rate does not exists with current stock id, then come and create a new row in stock and update the drage rate stock id to current stock id which is created now
    // first and second
    public function store(array $data)
    {

        // DB::beginTransaction();

        $goods = $data;
        unset($goods['made_date']);
        unset($goods['expired_date']);
        $thrityPercent = (string)round((($data['rate']) - ($data['rate'] * 30) / (100)) + $data['rate'], 2);
        $good = Good::create($goods);
        $dragExistInStock = Stock::whereDragName($data['drag_name'])->first();
        if (!empty($dragExistInStock)) {
            $dragRateStockId = DragRate::whereStockId($dragExistInStock->id)
                ->whereRate($thrityPercent)
                ->first();
            // thrid
            $dargRate = DragRate::create(
                [
                    "good_id" => $good->id,
                    "stock_id" => $dragExistInStock->id,
                    "rate" => $thrityPercent,
                    "made_date" => $data['made_date'],
                    "expired_date" => $data['expired_date'],
                ]
            );

            if (!empty($dragRateStockId)) {
                $dragExistInStock->update(['quantity' => $dragExistInStock->quantity + $data['quantity']]);
            } else {
                // fourth
                $addToStock = Stock::create(
                    [
                        'drag_name' => $data['drag_name'],
                        'quantity' => $data['quantity'],
                        'category_id' => $data['quantity'],
                    ]
                );
                $dargRate->update(['stock_id' => $addToStock->id]);
            }
        } else {
            $addToStock = Stock::create(
                [
                    'drag_name' => $data['drag_name'],
                    'quantity' => $data['quantity'],
                    'category_id' => $data['category_id'],
                ]
            );
            $dargRate = DragRate::create(
                [
                    "good_id" => $good->id,
                    "stock_id" => $addToStock->id,
                    "rate" => $thrityPercent,
                    "made_date" => $data['made_date'],
                    "expired_date" => $data['expired_date'],
                ]
            );
        }
    }

    public function update(array $data, object $good)
    {
        // this update need to be done via transaction
        $goods = $data;
        unset($goods['made_date']);
        unset($goods['expired_date']);
        $thrityPercent = (string)round((($data['rate']) - ($data['rate'] * 30) / (100)) + $data['rate'], 2);

        $drag_rate = DragRate::whereRate($thrityPercent)->whereGoodId($good->id)->first();

        // return $drag_rate;
        $checkStock = Stock::whereDragName($data['drag_name'])->whereId($good->dragRate->stock_id)->first();
        // return $checkStock;
        if (!empty($drag_rate) and !empty($checkStock)) {
            // return "here";

            // check to the quantity in both stock and and good
            $updateQunatity=$data['quantity']-$checkStock->quantity;
            if($updateQunatity>$checkStock->quantity){

                $checkStock->update(['quantity' => $checkStock->quantity+ $data['quantity']]);
            }else if($updateQunatity<$data['quantity']){
                $checkStock->update(['quantity' => $checkStock->quantity-$updateQunatity]);
            }

            $good->dragRate->update(
                [
                    'made_date' => $data['made_date'],
                    'expired_date' => $data['expired_date']
                ]
            );
        } else if ((empty($drag_rate) and !empty($checkStock)) or (!empty($drag_rate) and empty($checkStock))) {

            $dragExistInStock = Stock::whereDragName($data['drag_name'])->first();
            if (!empty($dragExistInStock)) {
                return "in else if first if name is the sam";
                $dragRateStockId = DragRate::whereStockId($dragExistInStock->id)
                    ->whereRate($thrityPercent)
                    ->first();
                if (!empty($dragRateStockId)) {
                     return "in else if first if name is the sam in first if";
                    $dragExistInStock->update(['quantity' => $dragExistInStock->quantity + $data['quantity']]);
                    $good->dragRate->update(
                        [
                            'rate' => $data['rate'],
                            'stock_id'=>$dragExistInStock->id,
                            'made_date' => $data['made_date'],
                            'expired_date' => $data['expired_date']
                        ]
                    );
                    $stockDelete=Stock::FindOrFail($drag_rate->stock_id);
                    $stockDelete->update(['quantity' => $stockDelete->quantity - $data['quantity']]);

                }
            }
            else{

                $stockDelete=Stock::FindOrFail($good->dragRate->stock_id);
                $stockDelete->update(['quantity' => $stockDelete->quantity - $data['quantity']]);
                // return "in else of first if";
                $createNewStock = Stock::create(
                    [
                        'drag_name' => $data['drag_name'],
                        'quantity' => $data['quantity'],
                        'category_id' => $data['quantity'],
                    ]
                );
                // return $data['rate'];
                    // return  "good  ".$good->dragRate;
               $i= $good->dragRate->update(
                    [
                        'rate' => $thrityPercent,
                        'stock_id'=>$createNewStock->id,
                        'made_date' => $data['made_date'],
                        'expired_date' => $data['expired_date']
                    ]
                );

            }
        }

        $checkGoodUpdateQuantity=$data['quantity']-$good->quantity;
        if($checkGoodUpdateQuantity>$good->quantity){
            $goods['quantity']=$good->quantity+$checkGoodUpdateQuantity;
        }else if($checkGoodUpdateQuantity<$good->quantity){
            $goods['quantity']=$good->quantity-$checkGoodUpdateQuantity;
        }
        return $good->update($goods);
    }
}
