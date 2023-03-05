<?php

namespace App\Http\Resources\Report\Good;

use Illuminate\Http\Resources\Json\JsonResource;

class GoodMonthlyReportResource extends JsonResource
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
            'total_drag'=>$this->total_drag,
            'totalPrice'=>$this->totalPrice,
            'month'=>$this->month
        ];
    }
}
