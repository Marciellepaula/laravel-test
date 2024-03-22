@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header w-100">
                <div class="d-flex w-100 justify-content-between">
                    <h3>Editar Funcionário</h3>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('funcionarios.update', $funcionarios->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input value="{{ $funcionarios->nome }}" type="text" class="form-control" id="nome"
                            name="nome" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="email">Email</label>
                        <input value="{{ $funcionarios->email }}" type="text" class="form-control" id="email"
                            name="email" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="salario">Salário</label>
                        <input value="{{ $funcionarios->salario }}" type="number" class="form-control" id="salario"
                            name="salario" required>
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-end gap-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-danger]">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
