<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\TrocoService;
class CursoTest extends TestCase
{
    public function testeCadastroDeCurso()
    {
        $this->visit('/cursos/create')
            ->type('Pedagogia', 'nome')
            ->type('154,65', 'valor_inscricao')
            ->type('1', 'periodo')
            ->press('Salvar')
            ->seeJsonContains([
                'error' => false,
                'callback' => '/cursos'
            ]);
    }
}
