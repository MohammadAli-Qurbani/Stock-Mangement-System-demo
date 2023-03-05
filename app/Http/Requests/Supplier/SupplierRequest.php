<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            "company_name"=>['required','string','min:3','max:100'],
            "phone"=>['required','string','min:10','max:16','unique:suppliers,phone'],
            "email"=>['required','email','unique:suppliers,email'],
            "city"=>['required','string','min:3','max:100'],
            "district"=>['required','string','min:3','max:100'],
        ];
    }
}
