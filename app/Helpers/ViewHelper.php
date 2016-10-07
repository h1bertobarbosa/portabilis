<?php
/**
 * Created by PhpStorm.
 * User: humberto
 * Date: 9/29/16
 * Time: 6:44 PM
 */

function formatDateTimeToView($dateTime)
{
    return preg_replace("/([0-9]{4})\-([0-9]{2})\-([0-9]{2}) ([0-9]{2})\:([0-9]{2})\:([0-9]{2})/", "$3/$2/$1 $4:$5", $dateTime);
}

function formatDateToView($date)
{
    return preg_replace("/([0-9]{4})\-([0-9]{2})\-([0-9]{2})/", "$3/$2/$1", $date);
}

function mascaraCPF($cpf)
{
    if(strlen($cpf) < 11)
        $cpf = str_pad($cpf,11,'0',STR_PAD_LEFT);

    return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{2})/", "$1.$2.$3-$4", $cpf);
}

function mascaraTelefone($tel)
{
    if(strlen($tel) > 10)
        return preg_replace("/([0-9]{2})([0-9]{5})([0-9]{4})/", "($1) $2-$3", $tel);

    return preg_replace("/([0-9]{2})([0-9]{4})([0-9]{4})/", "($1) $2-$3", $tel);
}

function mascaraDecimal($valor)
{
    if(empty($valor))
        return '0,00';

    return number_format($valor,2,",",".");
}

function notBlank($string)
{
    if(empty($string))
        return 'Não Informado';

    return $string;
}

function getPeriodo($id)
{
    switch ($id) {
        case 1:
            return 'Matutino';
        case 2:
            return 'Vespertino';
        case 3:
            return 'Integral';
    }
}

function MaskBoolean($bool)
{
    if($bool)
        return 'Sim';

    return 'Não';
}