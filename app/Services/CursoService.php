<?php
/**
 * Created by PhpStorm.
 * User: humberto
 * Date: 9/30/16
 * Time: 2:38 PM
 */

namespace App\Services;

use App\Curso;
use App\Validators\CursoValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Session;
use App\Traits\Functions;

class CursoService
{
    use Functions;
    /**
     * @var \App\Validators\CursoValidator
     */
    private $validator;

    public function __construct(CursoValidator $validator)
    {
        $this->validator = $validator;
    }

    public function store(array $data)
    {
        try{
            $data = $this->sanitize($data);
            $this->validator->validateWithCreate($data);

            $curso = Curso::create($data);

            if($curso->id) {
                Session::flash('success','Curso cadastrado com sucesso');
            }

            return [
                'error' => false,
                'response' => $curso,
                'callback' => '/cursos'
            ];
        }catch (ValidatorException $e) {
            return [
                'error' => true,
                'response' => $e->getMessageBag()
            ];
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function update(array $data,$id)
    {
        try{
            $data = $this->sanitize($data);
            $this->validator->validateWithUpdate($data,$id);

            $curso = Curso::find($id)->update($data);

            if($curso) {
                Session::flash('success','Curso editado com sucesso');
            }

            return [
                'error' => false,
                'response' => $curso,
                'callback' => '/cursos'
            ];
        }catch (ValidatorException $e) {
            return [
                'error' => true,
                'response' => $e->getMessageBag()
            ];
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function getCurso($id)
    {
        return Curso::firstOrNew(['id' => $id]);
    }

    public function getCursoEdit($id)
    {
        return Curso::findOrFail($id);
    }

    public function listCursos()
    {
        return Curso::paginate(10);
    }

    private function sanitize(array $data)
    {
        if(!empty($data['valor_inscricao']))
            $data['valor_inscricao'] = $this->formatValorToSaveDB($data['valor_inscricao']);

        return $data;
    }
}