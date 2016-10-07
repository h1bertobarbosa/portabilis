<?php
/**
 * Created by PhpStorm.
 * User: humberto
 * Date: 9/30/16
 * Time: 1:56 PM
 */

namespace App\Validators;


use App\Traits\Functions;

class CustomValidator
{
    use Functions;

    public function validateCpf($attribute, $value, $parameters, $validator)
    {
        $cpf = $this->soNumeros($value);
        // Valida tamanho
        if (strlen($cpf) != 11)
            return false;
        // Calcula e confere primeiro dígito verificador
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Calcula e confere segundo dígito verificador
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
    }
}