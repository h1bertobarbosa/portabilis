<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $fillable = [
        'aluno_id',
        'curso_id',
        'data_matricula',
        'ano',
        'ativo',
        'pago'
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class,'aluno_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class,'curso_id');
    }
}
