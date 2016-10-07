<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Aluno;
use App\Curso;
use App\Matricula;

class MatriculaTest extends TestCase
{
    use DatabaseTransactions;

    public function testeCadastroDeMatricula()
    {
        $aluno = Aluno::create([
            'nome' => 'Humberto Oliveira Barbosa',
            'data_nascimento' => '1987-12-28',
            'telefone' => '4891669898',
            'cpf' => '98109489729'
        ]);

        $curso = Curso::create([
            'nome' => 'Pedagogia',
            'valor_inscricao' => '154.65',
            'periodo' => 1
        ]);

        $this->visit('/matriculas/create')
            ->type($aluno->id, 'aluno_id')
            ->type($curso->id, 'curso_id')
            ->type('2016-03-12', 'data_matricula')
            ->type('2015', 'ano')
            ->press('Salvar')
            ->seeJsonContains([
                'error' => false,
                'callback' => '/matriculas'
            ]);
    }
    
}
