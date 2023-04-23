<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\CnpjUniqueRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EmpresaRequest extends FormRequest
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
            'nome'  => 'required|min:3|max:60',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'cnpj'  => ['required', 'cnpj', new CnpjUniqueRule],
            'senha'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required'    => 'O campo :attribute deve ser preenchido',
            'nome.min'    => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max'    => 'O campo nome deve ter no máximo 40 caracteres',
            'email.email' => 'Insira um email válido',
            'email.unique' => 'O email informado já possui cadastro no sistema',
            'cnpj.cnpj'   => 'Insira um CNPJ válido',
            'cnpj.unique' => 'O CNPJ informado já possui cadastro no sistema',
        ];
    }
}
