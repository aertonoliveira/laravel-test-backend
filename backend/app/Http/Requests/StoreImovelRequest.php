<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImovelRequest extends FormRequest
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
            'email' => 'required|email',
            'rua' => 'required',
            'bairro' => 'required',
            'estado_id' => 'required',
            'cidade_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'rua.required' => 'O nome da rua é obrigatorio',
            'bairro.required' => 'O nome do bairro é obrigatorio',
            'cidade_id.required' => 'O selecione a cidade',
            'estado_id.required' => 'Selecione o estado',
            'email.required' => 'O e-mail do propriétario é requerido',
            'email.email' => 'O e-mail é inválido'
        ];
    }
}
