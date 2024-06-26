<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductRequest extends FormRequest
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
            'nome' => ['required','min:3','max:255',"unique:products,nome,{$id},id"],
            'descricao' => ['nullable','min:3','max:10000'],
            'foto' => ['required','image'],
            'valor' => ['required',"regex:/^\d+(\.\d{1,2})?$/"],
        ];
        
        if ($this->method() == 'PUT'){
            $rules['foto'] = ['nullable','image'];
        }

        return $rules;
        
    }
}
