<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'alunos';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'rg',
        'data_nascimento'
    ];

    public function cursos()
    {
        return $this
            ->belongsToMany(
                Curso::class,
                'matriculas',
                'aluno_id',
                'curso_id'
            )
            ->withPivot(
                'data_matricula',
                'ano',
                'ativo',
                'pago'
            );
    }
}
