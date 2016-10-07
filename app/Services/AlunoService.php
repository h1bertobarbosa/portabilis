<?php
/**
 * Created by PhpStorm.
 * User: humberto
 * Date: 9/28/16
 * Time: 10:11 PM
 */

namespace App\Services;

use App\Aluno;
use App\Traits\Functions;
use App\Validators\AlunoValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Session;

class AlunoService
{
    /**
     * @var \App\Validators\AlunoValidator
     */
    private $validator;

    use Functions;

    public function __construct(AlunoValidator $validator)
    {
        $this->validator = $validator;
    }

    public function listAlunos()
    {
        return Aluno::paginate(10);
    }

    public function store(array $data)
    {
        try{
            $data = $this->sanitize($data);
            $this->validator->validateWithCreate($data);

            $aluno = Aluno::create($data);

            if($aluno->id) {
                Session::flash('success','Aluno cadastrado com sucesso');
            }

            return [
                'error' => false,
                'response' => $aluno,
                'callback' => '/alunos'
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

            $aluno = Aluno::find($id)->update($data);

            if($aluno) {
                Session::flash('success','Aluno editado com sucesso');
            }

            return [
                'error' => false,
                'response' => $aluno,
                'callback' => '/alunos'
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

    public function getAlunoEdit($id)
    {
        return Aluno::findOrFail($id);
    }

    public function getAluno($id)
    {
        return Aluno::firstOrNew(['id' => $id]);
    }

    private function sanitize(array $data)
    {
        $data['cpf'] = $this->soNumeros($data['cpf']);
        $data['telefone'] = $this->soNumeros($data['telefone']);
        $data['rg'] = $this->soNumeros($data['rg']);
        $data['data_nascimento'] = $this->formatDateToSaveDB($data['data_nascimento']);

        return $data;
    }
}