<?php
/**
 * Created by PhpStorm.
 * User: humberto
 * Date: 9/29/16
 * Time: 5:49 PM
 */

namespace App\Validators;

use Prettus\Validator\LaravelValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class AlunoValidator extends LaravelValidator
{
    public function validateWithCreate(array $data)
    {
        try{
            $rules = [
                'nome' => 'required',
                'data_nascimento' => 'required',
                'cpf' => 'required|cpf|unique:alunos,cpf'
            ];

            $this->setRules($rules)->with($data)->passesOrFail();

        }catch(ValidatorException $e){
            throw $e;
        }
    }

    public function validateWithUpdate(array $data,$id)
    {
        try{
            $rules = [
                'nome' => 'required',
                'data_nascimento' => 'required',
                'cpf' => 'required|cpf|unique:alunos,cpf,'.$id
            ];

            $this->setRules($rules)->with($data)->passesOrFail();

        }catch(ValidatorException $e){
            throw $e;
        }
    }
}