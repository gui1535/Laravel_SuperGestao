<?php

namespace App\Rules;

use App\Models\Empresa;
use Illuminate\Contracts\Validation\Rule;

class CnpjUniqueRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Removendo caracteres especiais do CNPJ
        $attribute = removerCaracteresEspeciais($value);

        // Procurando CNPJ
        $empresa = Empresa::where('cnpj', $attribute)->first();

        // Se existir uma empresa com o CNPJ
        return isset($empresa->id) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O CNPJ informado já possui cadastro no sistema';
    }
}
