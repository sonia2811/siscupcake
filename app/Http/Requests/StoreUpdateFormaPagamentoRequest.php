<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFormaPagamentoRequest extends FormRequest
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
        $id = $this->segment(3);
        
        $rules = [
            'nome' => ['required','min:3','max:255',"unique:products,title,{$id},id"],
            'descricao' => ['nullable','min:3','max:10000'],
        ];
        
        return $rules;
        
    }
}
