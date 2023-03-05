<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReturnedResource extends JsonResource
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
            'drag_name'=>$this->drag_name,
            'quantity'=>$this->quantity,
            'stock_id'=>$this->stock_id,
            'rate'=>$this->rate,
            'date'=>Carbon::parse($this->created_at)->toDateString(),
            'category_name'=>$this->category_name

        ];
    }
}
