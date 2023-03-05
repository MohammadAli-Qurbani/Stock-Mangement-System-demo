<?php

namespace App\Http\Resources\Sell;

use App\Http\Resources\Stock\StockResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SellResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            "rate"=>$this->rate,
            "quantity"=>$this->quantity,
            "total_rate"=>$this->total_rate,
            "date"=>$this->created_at->format('Y/m/d'),
            "exact_date"=>$this->created_at->diffForHumans(),
            "stock"=>new StockResource($this->whenLoaded('stock'))
        ];
    }
}
