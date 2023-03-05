<?php

namespace App\Http\Resources\Good;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\DragRate\DragRateResource;
use App\Http\Resources\Supplier\SupplierResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'drag_name'=>$this->drag_name,
            'rate'=>$this->rate,
            'total_price'=>$this->total_price,
            'quantity'=>$this->quantity,
            'description'=>$this->description,
            'boughtDate'=>$this->created_at->format('Y/m/d'),
            'category'=> new CategoryResource($this->whenLoaded('category')),
            'supplier'=>new SupplierResource($this->whenLoaded('supplier')),
            'dragRate'=>new DragRateResource($this->whenLoaded('dragRate'))


        ];
    }





}
