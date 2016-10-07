<?php
/**
 * Created by PhpStorm.
 * User: humberto
 * Date: 9/28/16
 * Time: 10:11 PM
 */

namespace App\Services;

use App\Aluno;
use App\Curso;
use App\Matricula;
use App\Traits\Functions;
use App\Validators\MatriculaValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Session;

class MatriculaService
{
    /**
     * @var \App\Validators\MatriculaValidator
     */
    private $validator;

    use Functions;

    public function __construct(MatriculaValidator $validator)
    {
        $this->validator = $validator;
    }

    public function listMatriculas()
    {
        return Matricula::paginate(10);
    }

    public function store(array $data)
    {
        try{
            $data = $this->sanitize($data);
            $data['ativo'] = 1;
            $data['pago'] = 0;
            $this->validator->validateWithCreate($data);

            $matricula = Matricula::create($data);

            if($matricula->id) {
                Session::flash('success','Matricula cadastrado com sucesso');
            }

            return [
                'error' => false,
                'response' => $matricula,
                'callback' => '/matriculas'
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

            $matricula = Matricula::find($id)->update($data);

            if($matricula) {
                Session::flash('success','Matricula editado com sucesso');
            }

            return [
                'error' => false,
                'response' => $matricula,
                'callback' => '/matriculas'
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

    public function getMatriculaEdit($id)
    {
        return Matricula::findOrFail($id);
    }

    public function getMatricula($id)
    {
        return Matricula::firstOrNew(['id' => $id]);
    }

    public function getAlunosList()
    {
        return Aluno::pluck('nome', 'id');
    }

    public function getCursosList()
    {
        return Curso::pluck('nome', 'id');
    }

    public function buscar(array $params)
    {

        unset($params['_token'],$params['_']);
        $params['ativo'] = '1';

        if(isset($params['inativas']))
            unset($params['ativo']);

        if(isset($params['pago']))
            $params['pago'] = '1';

        if(Session::has('params_matricula')) {
            if(Session::get('params_matricula') != $params){
                Session::forget('params_matricula');
                Session::put('params_matricula',$params);
            }
        }else{
            Session::put('params_matricula',$params);
        }

        foreach($params as $k => $val){
            if(empty($val)){
                unset($params[$k]);
                continue;
            }
        }

        $ignoreFields = [
            'page',
            'inativas'
        ];
        
        $matricula = new Matricula();

        foreach ($params as $field => $value) {
            if(!in_array($field,$ignoreFields)) {
                if ( is_array($value) ) {
                    list($field, $condition, $val) = $value;
                    $matricula = $matricula->where($field,$condition,$val);
                } else {
                    $matricula = $matricula->where($field,'=',$value);
                }
            }
        }

        return $matricula->paginate(10);
    }

    public function cancelar($id)
    {
        if (Matricula::find($id)
            ->update([
                'ativo' => '0'
            ])
        ) {
            return ['error' => 'false'];
        }

        return ['error' => 'true'];
    }

    public function pagamento($id)
    {
        if (Matricula::find($id)
            ->update([
                'pago' => '1'
            ])
        ) {
            return ['error' => 'false'];
        }

        return ['error' => 'true'];
    }

    private function sanitize(array $data)
    {
        $data['data_matricula'] = $this->formatDateToSaveDB($data['data_matricula']);

        return $data;
    }
}