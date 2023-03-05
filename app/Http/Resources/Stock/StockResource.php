<?php

namespace App\Http\Resources\Stock;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\DragRate\DragRateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
            'drag_name'=>$this->drag_name,
            'quantity'=>$this->quantity,
            'drag_rate'=>DragRateResource::collection($this->whenLoaded('drag_rates')),
            'category'=> new CategoryResource($this->whenLoaded('category')),
            'drag_rateCompanies'=>DragRateResource::collection($this->whenLoaded('drag_rateCompanies'))
        ];
    }
}
