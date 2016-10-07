<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\TrocoService;
class AlunoTest extends TestCase
{
    use DatabaseTransactions;

    public function testeCadastroDeAluno()
    {
        $this->visit('/alunos/create')
            ->type('Humberto Oliveira Barbosa', 'nome')
            ->type('28/12/1987', 'data_nascimento')
            ->type('(48) 9166-9898', 'telefone')
            ->type('707.465.429-92', 'cpf')
            ->type('985590', 'rg')
            ->press('Salvar')
            ->seeJsonContains([
                'error' => false,
                'callback' => '/alunos'
            ]);
    }

    public function testeRegrasDeCPF()
    {
        $this->visit('/alunos/create')
            ->type('Humberto Oliveira Barbosa', 'nome')
            ->type('28/12/1987', 'data_nascimento')
            ->type('(48) 9166-9898', 'telefone')
            ->type('707.465.429-92', 'cpf')
            ->type('985590', 'rg')
            ->press('Salvar')
            ->seeJsonContains([
                'error' => false,
                'callback' => '/alunos'
            ]);

        $this->visit('/alunos/create')
            ->type('Humberto Oliveira Barbosa', 'nome')
            ->type('28/12/1987', 'data_nascimento')
            ->type('(48) 9166-9898', 'telefone')
            ->type('707.465.429-92', 'cpf')
            ->type('985590', 'rg')
            ->press('Salvar')
            ->seeJsonContains([
                'error' => true,
                'cpf' => ['O cpf já está sendo usado.']
            ]);

        $this->visit('/alunos/create')
            ->type('Humberto Oliveira Barbosa', 'nome')
            ->type('28/12/1987', 'data_nascimento')
            ->type('(48) 9166-9898', 'telefone')
            ->type('111.222.333-92', 'cpf')
            ->type('985590', 'rg')
            ->press('Salvar')
            ->seeJsonContains([
                'error' => true,
                'cpf' => ['O cpf não é válido']
            ]);
    }
}
