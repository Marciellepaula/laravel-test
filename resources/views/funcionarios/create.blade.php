@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Criar Funcionário</h1>
            <form action="{{ route('funcionarios.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="salario">Salário</label>
                    <input type="number" class="form-control" id="salario" name="salario" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create Funcionario</button>
                    <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
