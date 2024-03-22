@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card px-0 mt-4">
                <div class="card-header">Lista de Funcionários</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Salario</th>
                                <th>Data Criação</th>
                                <th>Última Atualização</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                </td>
                                <td>{{ $funcionario->nome }}</td>
                                <td>{{ $funcionario->email }}</td>
                                <td>R$ {{ number_format($funcionario->salario, 2, ',', '.') }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($funcionario->created_at)->format('d/m/Y \à\s H:i\h') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($funcionario->updated_at)->format('d/m/Y \à\s H:i\h') }}
                                </td>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
