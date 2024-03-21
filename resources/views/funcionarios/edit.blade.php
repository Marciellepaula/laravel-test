@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Editar Funcionário</h1>
            <form action="{{ route('funcionarios.update', $funcionarios->id) }}" method="post">
                @csrf
                @method('PUT') <!-- Add this line to specify the method as PUT for update -->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input value="{{ $funcionarios->nome }}" type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input value="{{ $funcionarios->email }}" type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="salario">Salário</label>
                    <input value="{{ $funcionarios->salario }}" type="number" class="form-control" id="salario" name="salario" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Editar</button>
                    <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">Cancelar</a> <!-- "Cancelar" instead of "Cancel" -->
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
