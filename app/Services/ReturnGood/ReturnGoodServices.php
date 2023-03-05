<?php
namespace App\Services\ReturnGood;
use App\Models\DragRate;
use App\Models\Good;
use App\Models\Returned;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ReturnGoodServices{

    public function index(string|null $searchParm=null){
      return  Returned::with('stock.category')
        ->when($searchParm, function ($returned) use ($searchParm) {
            $returned->whereHas('stock', function ($query) use ($searchParm) {
                $query->where('drag_name', 'like', "%{$searchParm}%");
            });
        })
        ->paginate(2)->withQueryString();
    }
    public function store(Object $request){
        DB::beginTransaction();

        foreach ($request->data as $key => $value) {

            $good = Good::findOrFail($value['good_id']);
            $drag_rate = DragRate::with('stock')->whereGoodId($value['good_id'])->first();

            if ($value['qunatity'] > $drag_rate->stock->quantity) {
                return response(['errors' => 'selected quantity is greater than vailable quantity of stock'], Response::HTTP_FORBIDDEN);
            } else {
                $updateGood = [
                    'quantity' => $good->quantity - $value['qunatity'],
                    'total_price' => $good->rate * ($good->quantity - $value['qunatity'])
                ];

                $goodUpdate = $good->update($updateGood);
                $stockUpdate =   $drag_rate->stock->update(
                    [
                        'quantity' => $drag_rate->stock->quantity - $value['qunatity']
                    ]
                );


                if (!$goodUpdate and !$stockUpdate) {
                    DB::rollBack();
                    return response(['errors' => 'returned process failed please try again'], Response::HTTP_FORBIDDEN);
                }
                $returned = $good->returneds()->create(
                    [
                        'qunatity' =>  $value['qunatity'],
                        'stock_id'=>$drag_rate->stock->id
                    ]
                );
                if ($returned) {
                    DB::commit();
                } else {
                    DB::rollBack();
                    return response(['errors' => 'returned process failed please try again'], Response::HTTP_FORBIDDEN);
                }
            }
            // $stock = Stock::findOrFail($value['stock_id']);
            // $stockUpdate = $stock->update(['quantity' => $stock->quantity - $value['qunatity']]);
            // if (!$stockUpdate) {
            //     DB::rollBack();
            //     return false;
            // }
            // $returned = $stock->returneds()->create(['qunatity' => $value['qunatity']]);
            // if ($returned) {
            //     DB::commit();
            //     return true;
            // } else {
            //     DB::rollBack();
            // }
        }
    }
}
