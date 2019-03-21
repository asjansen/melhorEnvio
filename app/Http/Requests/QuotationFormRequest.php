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
            'height' => 'required|numeric|digits_between:1,3',
            'width' => 'required|numeric|digits_between:1,3',
            'length' => 'required|numeric|digits_between:1,3',
            'weight' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'from_cep.required' => 'O CEP de origem é obrigatório',
            'from_cep.size' => 'O CEP de origem deve ter 10 dígitos',
            'to_cep.required' => 'O CEP de destino é obrigatório',
            'to_cep.size' => 'O CEP de destino deve ter 10 dígitos',
            'height.required' => 'A altura é obrigatória',
            'height.numeric' => 'A altura deve ser composta de números',
            'height.digits_between' => 'A altura deve ter de 1 a 3 dígitos',
            'width.required' => 'A largura é obrigatória',
            'width.numeric' => 'A largura deve ser composta de números',
            'width.digits_between' => 'A largura deve ter de 1 a 3 dígitos',
            'length.required' => 'O comprimento é obrigatório',
            'length.numeric' => 'O comprimento deve ser composto de números',
            'length.digits_between' => 'O comprimento deve ter de 1 a 3 dígitos',
            'weight.required' => 'O peso é obrigatório',
            'weight.numeric' => 'O peso deve ser composto de números',
            'weight.digits_between' => 'O peso deve ter de 1 a 3 dígitos'
        ];
    }
}
