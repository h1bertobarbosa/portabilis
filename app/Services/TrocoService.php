<?php
/**
 * Created by PhpStorm.
 * User: humberto
 * Date: 10/5/16
 * Time: 8:11 PM
 */

namespace App\Services;


class TrocoService
{
    private $notas;

    public function __construct($notas)
    {
        $this->notas = $notas;
    }

    public function retornaTroco($valorTroco)
    {
        $troco = [];

        foreach ($this->notas as $nota => $valorNota) {
            if($valorTroco >= $valorNota) {
                $qtdeNota = floor($valorTroco/$valorNota);
                $troco [$nota] = $qtdeNota;
                $valorTroco -= $qtdeNota * $valorNota;
            }
        }

        return $troco;
    }
}