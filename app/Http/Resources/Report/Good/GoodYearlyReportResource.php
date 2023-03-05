<?php

namespace App\Http\Resources\Report\Good;

use Illuminate\Http\Resources\Json\JsonResource;

class GoodYearlyReportResource extends JsonResource
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
            'year'=>$this->year
        ];
    }
}
