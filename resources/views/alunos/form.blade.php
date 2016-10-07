@extends('app')

@section('content')
    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    @if($aluno->id)
                        Editar
                    @else
                        Novo
                    @endif
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">

            <div class="col-lg-12">
                <div id="msg_user"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Aluno
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if($aluno->id)
                                    {!! Form::open(['action'=>['AlunoController@update',$aluno->id], 'role' => 'form','method' => 'put']) !!}
                                @else
                                    {!! Form::open(['action'=>'AlunoController@store', 'role' => 'form']) !!}
                                @endif
                                    <div class="form-group">
                                        {!!
                                            Form::text('nome',$aluno->nome,[
                                                'class'=>'form-control',
                                                'placeholder' => 'Nome',
                                                'id' => 'nome'
                                            ])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!!
                                            Form::text('data_nascimento',($aluno->data_nascimento)?formatDateToView($aluno->data_nascimento):null,[
                                                'class'=>'form-control',
                                                'placeholder' => 'Data de Nascimento',
                                                'id' => 'data_nascimento'
                                            ])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!!
                                            Form::text('telefone',($aluno->telefone)?mascaraTelefone($aluno->telefone):null,[
                                                'class'=>'form-control',
                                                'placeholder' => 'Telefone',
                                                'id' => 'telefone'
                                            ])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!!
                                            Form::text('cpf',($aluno->cpf)?mascaraCPF($aluno->cpf):null,[
                                                'class'=>'form-control',
                                                'placeholder' => 'CPF',
                                                'id' => 'cpf'
                                            ])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!!
                                            Form::text('rg',$aluno->rg,[
                                                'class'=>'form-control',
                                                'placeholder' => 'RG',
                                                'id' => 'rg'
                                            ])
                                        !!}
                                    </div>

                                    <button type="submit" class="btn btn-success">Salvar</button>
                                    <a href="{{ route('alunos.index') }}" type="reset" class="btn btn-default">Cancelar</a>
                                {!! Form::close() !!}
                            </div>
                            <!-- /.col-lg-6 (nested) -->

                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/alunos.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            main.submeter();
            aluno.mascara();
            aluno.isAnoBissexto();

        });
    </script>
@endsection