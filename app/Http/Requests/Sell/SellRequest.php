<?php

namespace App\Http\Requests\Sell;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'sells.*.stock_id'=>'required',
            'sells.*.quantity'=>'required',
            "sells.*.rate"=>'required',
            'sells.*.total_rate'=>'required'
        ];
    }
}
