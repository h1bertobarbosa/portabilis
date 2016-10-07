@extends('app')

@section('content')
    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    @if($matricula->id)
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
                        Matricula
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if($matricula->id)
                                    {!! Form::open(['action'=>['MatriculasController@update',$matricula->id], 'role' => 'form','method' => 'put']) !!}
                                @else
                                    {!! Form::open(['action'=>'MatriculasController@store', 'role' => 'form']) !!}
                                @endif
                                    <div class="form-group">
                                        {!!
                                            Form::select('aluno_id',$alunos,$matricula->aluno_id,[
                                                'class'=>'form-control',
                                                'placeholder' => 'Aluno',
                                                'id' => 'aluno_id'
                                            ])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!!
                                            Form::select('curso_id',$cursos,$matricula->curso_id,[
                                                'class'=>'form-control',
                                                'placeholder' => 'Curso',
                                                'id' => 'curso_id'
                                            ])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!!
                                            Form::text('data_matricula',formatDateToView($matricula->data_matricula),[
                                                'class'=>'form-control',
                                                'placeholder' => 'Data da Matricula',
                                                'id' => 'data_matricula'
                                            ])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!!
                                            Form::text('ano',$matricula->ano,[
                                                'class'=>'form-control',
                                                'placeholder' => 'Ano',
                                                'id' => 'ano'
                                            ])
                                        !!}
                                    </div>

                                    <button type="submit" class="btn btn-success">Salvar</button>
                                    <a href="{{ route('matriculas.index') }}" type="reset" class="btn btn-default">Cancelar</a>
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
    <script src="{{ asset('js/matriculas.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            main.submeter();
            matricula.mascara();
        });
    </script>
@endsection