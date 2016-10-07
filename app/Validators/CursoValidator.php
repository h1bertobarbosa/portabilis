<?php
/**
 * Created by PhpStorm.
 * User: humberto
 * Date: 9/30/16
 * Time: 2:45 PM
 */

namespace App\Validators;

use Prettus\Validator\LaravelValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class CursoValidator extends LaravelValidator
{
    public function validateWithCreate(array $data)
    {
        try{
            $rules = [
                'nome' => 'required',
                'valor_inscricao' => 'required',
                'periodo' => 'required'
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
                'valor_inscricao' => 'required',
                'periodo' => 'required'
            ];

            $this->setRules($rules)->with($data)->passesOrFail();

        }catch(ValidatorException $e){
            throw $e;
        }
    }
}