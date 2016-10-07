@extends('app')

@section('content')

    <div id="page-wrapper">
        @include('notifications.success')
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Lista de matrículas
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            {!! Form::open([
                                    'action'=>'MatriculasController@buscar',
                                    'role' => 'form',
                                    'class' => 'form-inline'
                                ])
                            !!}
                            <div class="form-group">
                                <input value="{{ session('params_matricula.ano') }}" type="text" class="form-control" id="ano" name="ano" placeholder="Ano">
                            </div>
                            <div class="form-group">
                                {!!
                                    Form::select('aluno_id',$alunos,session('params_matricula.aluno_id'),[
                                        'class'=>'form-control',
                                        'placeholder' => 'Aluno',
                                        'id' => 'aluno_id'
                                    ])
                                !!}
                            </div>
                            <div class="form-group">
                                {!!
                                    Form::select('curso_id',$cursos,null,[
                                        'class'=>'form-control',
                                        'placeholder' => 'Curso',
                                        'id' => 'curso_id'
                                    ])
                                !!}
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input {{ session('params_matricula.inativas')?'checked':null }} name="inativas" type="checkbox"> Inativas
                                </label>
                                <label>
                                    <input name="pago" type="checkbox"> Pagas
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        {!! Form::close() !!}
                    </div>

                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Aluno</th>
                                        <th>Curso</th>
                                        <th>Ano</th>
                                        <th>Data Matrícula</th>
                                        <th>Ativo</th>
                                        <th>Pago</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($matriculas as $matricula)
                                <tr>
                                    <td>{{ $matricula->id }}</td>
                                    <td>{{ $matricula->aluno->nome }}</td>
                                    <td>{{ $matricula->curso->nome }}</td>
                                    <td>{{ $matricula->ano }}</td>
                                    <td>{{ formatDateToView($matricula->data_matricula) }}</td>
                                    <td>{{ MaskBoolean($matricula->ativo) }}</td>
                                    <td>{{ MaskBoolean($matricula->pago) }}</td>
                                    <td>
                                        <a title="Editar" href="{{ route('matriculas.edit',['id' => $matricula->id]) }}" class="btn btn-xs btn-default">
                                            <span class="fa fa-pencil fa-fw"></span>
                                        </a>
                                        <a title="Cancelar" id="cancelar" href="{{ action('MatriculasController@cancelar',['id' => $matricula->id]) }}" class="btn btn-xs btn-danger">
                                            <span class="fa fa-exclamation fa-fw"></span>
                                        </a>
                                        <a title="Pagar" id="pagar" href="{{ action('MatriculasController@pagamento',['id' => $matricula->id]) }}" class="btn btn-xs btn-success">
                                            <span class="fa fa-bank fa-fw"></span>
                                        </a>
                                        <a title="Informar Valor" id="infValor" href="{{ action('MatriculasController@getTroco',['id' => $matricula->curso->valor_inscricao]) }}" class="btn btn-xs btn-success">
                                            <span class="fa fa-money fa-fw"></span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $matriculas->links() }}
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/matriculas.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            matricula.cancelar();
            matricula.pagar();
            matricula.informarValor();
        });
    </script>
@endsection
