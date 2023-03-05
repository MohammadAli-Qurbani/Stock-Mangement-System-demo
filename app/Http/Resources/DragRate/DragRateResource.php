<?php

namespace App\Http\Resources\DragRate;

use App\Http\Resources\Good\GoodResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DragRateResource extends JsonResource
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
            'id' => $this->id,
            'rate' => $this->rate,
            'made_date' => $this->made_date,
            'expired_date' => $this->expired_date,
            'good'=>new GoodResource($this->whenLoaded('good'))
        ];
    }
}
