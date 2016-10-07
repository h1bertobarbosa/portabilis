<?php
/**
 * Created by PhpStorm.
 * User: humberto
 * Date: 06/11/15
 * Time: 17:58
 */

namespace App\Traits;


trait Functions
{
    public function soNumeros($str)
    {
        if(empty($str)){
            return null;
        }
        return preg_replace("([^0-9])", "", $str);
    }

    public function formatDateToSaveDB($date)
    {
        if(empty($date)){
            return null;
        }
        return preg_replace("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", "$3-$2-$1", $date);
    }

    public function formatValorToSaveDB($valor)
    {
        if(empty($valor)) {
            $valor = 0;
        }

        return str_replace(['.',','],['','.'],$valor);
    }
}