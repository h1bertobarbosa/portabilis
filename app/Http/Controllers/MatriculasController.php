<?php

namespace App\Http\Controllers;

use App\Services\MatriculaService;
use App\Services\TrocoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class MatriculasController extends Controller
{
    /**
     * @var \App\Services\MatriculaService
     */
    private $service;

    public function __construct(MatriculaService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Session::flush();
        if(Session::has('params_matricula')){
            $matriculas = $this->service->buscar(Session::get('params_matricula'));
        }else{
            $matriculas = $this->service->listMatriculas();
        }

        return view('matriculas.list',[
            'matriculas' => $matriculas,
            'alunos' => $this->service->getAlunosList(),
            'cursos' => $this->service->getCursosList()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('matriculas.form',[
            'matricula' => $this->service->getMatricula(0),
            'alunos' => $this->service->getAlunosList(),
            'cursos' => $this->service->getCursosList()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->store($request->all());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('matriculas.form',[
            'matricula' => $this->service->getMatriculaEdit($id),
            'alunos' => $this->service->getAlunosList(),
            'cursos' => $this->service->getCursosList()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(),$id);
    }

    public function buscar(Request $request)
    {
        $matriculas = $this->service->buscar($request->all());

        return view('matriculas.list',[
            'matriculas' => $matriculas,
            'alunos' => $this->service->getAlunosList(),
            'cursos' => $this->service->getCursosList()
        ]);
    }

    public function cancelar($id)
    {
        return $this->service->cancelar($id);
    }

    public function pagamento($id)
    {
        return $this->service->pagamento($id);
    }

    public function getTroco(Request $request,$valorInscricao)
    {
        $notas = [
            '100R$' => 100,
            '50R$' => 50,
            '10R$' => 10,
            '5R$' => 5,
            '1R$' => 1,
            '50C' => 0.50,
            '10C' => 0.10,
            '5C' => 0.05,
            '1C' => 0.01,
        ];

        $data = $request->all();
        $valorEntregue = str_replace(['.',','],['','.'],$data['valorEntregue']);

        $troco = $valorEntregue - $valorInscricao;

        $trocoService = new TrocoService($notas);
        
        $trocoNotas = $trocoService->retornaTroco($troco);

        $str = '';
        foreach ($trocoNotas as $nota => $qtd) {
            $str .= $qtd.' cedula(s)/moeda(s) de '.$nota.PHP_EOL;
        }

        return $str;
    }
}
