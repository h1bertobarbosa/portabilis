@extends('app')

@section('content')

    <div id="page-wrapper">
        @include('notifications.success')
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Lista de Alunos
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Alunos
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>CPF</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($alunos as $aluno)
                                <tr>
                                    <td>{{ $aluno->id }}</td>
                                    <td>{{ $aluno->nome }}</td>
                                    <td>{{ ($aluno->telefone)?mascaraTelefone($aluno->telefone):notBlank($aluno->telefone) }}</td>
                                    <td>{{ mascaraCPF($aluno->cpf) }}</td>
                                    <td>
                                        <a title="Editar" href="{{ route('alunos.edit',['id' => $aluno->id]) }}" class="btn btn-xs btn-success">
                                            <span class="fa fa-pencil fa-fw"></span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $alunos->links() }}
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
