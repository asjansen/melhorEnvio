<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'from_cep' => 'required|size:10',
            'to_cep' => 'required|size:10',
            'height' => 'required|numeric|min:1|max:3',
            'width' => 'required|numeric|min:1|max:3',
            'length' => 'required|numeric|min:1|max:3',
            'weight' => 'required|numeric'
        ];
    }

    public function messages()
    {

    }
}
