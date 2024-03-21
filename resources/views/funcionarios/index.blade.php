@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="fw-bold">Funcionarios</h3>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('funcionarios.create') }}" class="btn btn-sm btn-primary">
                                    Criar Funcionario
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Cargo</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($funcionarios as $funcionario)
                                    <tr>
                                        <td>{{ $funcionario->nome }}</td>
                                        <td>{{ $funcionario->email }}</td>
                                        <td>
                                            <a href="{{ route('funcionarios.show', $funcionario->id) }}"
                                                class="btn btn-sm btn-primary">
                                                View
                                            </a>
                                            <a href="{{ route('funcionarios.edit', $funcionario->id) }}"
                                                class="btn btn-sm btn-secondary">
                                                Edit
                                            </a>
                                            <form action="{{ route('funcionarios.destroy', $funcionario->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this funcionario?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3">
                                            Nenhum Funcionario encontrado!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
