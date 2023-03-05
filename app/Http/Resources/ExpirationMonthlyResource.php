<?php

namespace App\Http\Resources;

use App\Http\Resources\DragRate\DragRateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpirationMonthlyResource extends JsonResource
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
            "drag_name"=>$this->drag_name,
            "quantity"=>$this->quantity,
            'submitDate'=>$this->created_at->diffForHumans(),
            'date'=>$this->created_at->toDateString(),
            'drag_rate'=>DragRateResource::collection($this->whenLoaded('drag_rates'))
        ];
    }
}
