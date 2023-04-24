<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FornecedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'  => 'required|min:3|max:50',
            'email' => 'required|email',
            'uf'  => 'required',
            'site'  => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 50 caracteres',
            'site.max' => 'O campo site deve ter no máximo 50 caracteres',
            'email.email' => 'Insira um email válido',
        ];
    }
}
