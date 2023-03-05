<?php

namespace App\Http\Resources;

use App\Http\Resources\DragRate\DragRateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpiredGoodResource extends JsonResource
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
            'quantity'=>$this->quantity,
            'bougth_date'=>$this->created_at->format('Y-m-d'),
            'year'=>$this->created_at->year,
            'drag_rate'=>DragRateResource::collection($this->whenLoaded('drag_rates'))
        ];
    }
}
