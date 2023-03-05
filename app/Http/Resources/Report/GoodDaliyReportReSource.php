<?php

namespace App\Http\Resources\Report;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GoodDaliyReportReSource extends JsonResource
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
            'totalPrice'=>$this->totalPrice,
            "created_at"=>Carbon::parse($this->created_at)->diffForHumans()
        ];
    }
}
