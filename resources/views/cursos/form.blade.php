@extends('app')

@section('content')
    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    @if($curso->id)
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
                        Curso
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if($curso->id)
                                    {!! Form::open(['action'=>['CursosController@update',$curso->id], 'role' => 'form','method' => 'put']) !!}
                                @else
                                    {!! Form::open(['action'=>'CursosController@store', 'role' => 'form']) !!}
                                @endif
                                    <div class="form-group">
                                        {!!
                                            Form::text('nome',$curso->nome,[
                                                'class'=>'form-control',
                                                'placeholder' => 'Nome',
                                                'id' => 'nome'
                                            ])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!!
                                            Form::text('valor_inscricao',mascaraDecimal($curso->valor_inscricao),[
                                                'class'=>'form-control',
                                                'placeholder' => 'Valor da Inscrição',
                                                'id' => 'valor_inscricao'
                                            ])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!!
                                            Form::select('periodo',[
                                                '1' => 'Matutino',
                                                '2' => 'Vespertino',
                                                '3' => 'Integral'
                                            ],$curso->periodo,[
                                                'class'=>'form-control',
                                                'placeholder' => 'Período',
                                                'id' => 'periodo'
                                            ])
                                        !!}
                                    </div>
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                    <a href="{{ route('cursos.index') }}" type="reset" class="btn btn-default">Cancelar</a>
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
    <script src="{{ asset('js/cursos.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            main.submeter();
            curso.mascara();
        });
    </script>
@endsection