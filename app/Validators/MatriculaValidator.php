<?php
/**
 * Created by PhpStorm.
 * User: humberto
 * Date: 9/29/16
 * Time: 5:49 PM
 */

namespace App\Validators;

use App\Aluno;
use App\Curso;
use Illuminate\Support\MessageBag;
use Prettus\Validator\LaravelValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class MatriculaValidator extends LaravelValidator
{
    public function validateWithCreate(array $data)
    {
        try{
            $rules = [
                'aluno_id' => 'required',
                'curso_id' => 'required',
                'data_matricula' => 'required',
                'ano' => 'required'
            ];

            $this->setRules($rules)->with($data)->passesOrFail();

            if($this->temMatriculaPeriodoAno($data))
                throw new ValidatorException( new MessageBag(['curso_id' => 'Aluno já esta matriculado no curso neste periodo e ano']) );

        }catch(ValidatorException $e){
            throw $e;
        }
    }

    public function validateWithUpdate(array $data,$id)
    {
        try{
            $rules = [
                'aluno_id' => 'required',
                'curso_id' => 'required',
                'data_matricula' => 'required',
                'ano' => 'required'
            ];

            $this->setRules($rules)->with($data)->passesOrFail();

            if($this->temMatriculaPeriodoAno($data))
                throw new ValidatorException( new MessageBag(['curso_id' => 'Aluno já esta matriculado no curso neste periodo e ano']) );

        }catch(ValidatorException $e){
            throw $e;
        }
    }

    private function temMatriculaPeriodoAno(array $data)
    {
        $cursos = Aluno::find($data['aluno_id'])->cursos;
        $cursoMatricula = Curso::find($data['curso_id']);

        foreach ($cursos as $curso) {
            if($curso->pivot->curso_id == $cursoMatricula->id) {
                if($curso->pivot->ano == $data['ano'] && $curso->periodo == $cursoMatricula->periodo) {
                    return true;
                }
            }
        }

        return false;
    }
}