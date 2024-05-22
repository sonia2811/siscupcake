<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFormaEnvioRequest extends FormRequest
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
            'nome' => ['required','min:3','max:255',"unique:forma_envios,nome,{$id},id"],
            'valor' => ['required'],
        ];
        
        return $rules;
        
    }
}
