<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContratoRequest extends FormRequest
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
        $validacao = request('tipo_pessoa') == 'F' ? "/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/" : "/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/";
        return [
            'tipo_pessoa' => 'required',
            'documento' => 'required|regex:'.$validacao,
            'email' => 'required|email',
            'nome_completo' => 'required',
            'imovel_id' => 'required|unique:contratos|exists:imovels,id'
        ];
    }

    public function messages()
    {
        return [
            'documento.required' => 'O Documento é obrigatorio',
            'documento.regex' => 'O formato do documento é invalido',
            'tipo_pessoa.required' => 'O tipo da pessoa é obrigatorio',
            'nome_completo.required' => 'O nome completo é obrigatorio',
            'email.required' => 'O e-mail do propriétario é requerido',
            'email.email' => 'O e-mail é inválido',
            'imovel_id.required' => 'Selecione o Imovel',
            'imovel_id.unique' => 'Esse Imovel já esta contrato',
            'imovel_id.exists' => 'Esse Imovel Não existe',
        ];
    }
}
