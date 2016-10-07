<?php

namespace App\Http\Controllers;

use App\Services\AlunoService;
use Illuminate\Http\Request;
use App\Aluno;
use App\Curso;
use App\Http\Requests;

class AlunoController extends Controller
{
    private $service;

    public function __construct(AlunoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('alunos.list',[
            'alunos' => $this->service->listAlunos()
        ]);
    }

    public function create()
    {
        return view('alunos.form',[
            'aluno' => $this->service->getAluno(0)
        ]);
    }

    public function store(Request $request)
    {
        return $this->service->store($request->all());
    }

    public function edit($id)
    {
        return view('alunos.form',[
            'aluno' => $this->service->getAlunoEdit($id)
        ]);
    }

    public function update(Request $request,$id)
    {
        return $this->service->update($request->all(),$id);
    }
}
