<?php

namespace App\Http\Requests\Good;

use Illuminate\Foundation\Http\FormRequest;

class GoodRequest extends FormRequest
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
            "supplier_id"=>['required','integer','exists:suppliers,id'],
            "category_id"=>['required','integer','exists:categories,id'],
            "drag_name"=>['required','string'],
            "made_date"=>['required','date'], #made date store in drage rate
            "expired_date"=>['required','date','after:made_date'] ,#also expored date store in drag store
            "quantity"=>['required','integer'],
            "description"=>['required','string'],
            "rate"=>['required'],
            'total_price'=>['required']
        ];
    }
}
