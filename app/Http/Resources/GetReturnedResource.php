<?php

namespace App\Http\Resources;

use App\Http\Resources\Stock\StockResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GetReturnedResource extends JsonResource
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
            'date'=>$this->created_at->toDateString(),
            'returned_quantity' => $this->qunatity,
            'stock' => new StockResource($this->whenLoaded('stock'))
        ];
    }
}
