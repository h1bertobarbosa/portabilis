@extends('app')

@section('content')

    <div id="page-wrapper">
        @include('notifications.success')
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Lista de Cursos
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Cursos
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Valor da Inscrição</th>
                                    <th>Período</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cursos as $curso)
                                <tr>
                                    <td>{{ $curso->id }}</td>
                                    <td>{{ $curso->nome }}</td>
                                    <td>{{ mascaraDecimal($curso->valor_inscricao) }}</td>
                                    <td>{{ getPeriodo($curso->periodo) }}</td>
                                    <td>
                                        <a title="Editar" href="{{ route('cursos.edit',['id' => $curso->id]) }}" class="btn btn-xs btn-success">
                                            <span class="fa fa-pencil fa-fw"></span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $cursos->links() }}
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
