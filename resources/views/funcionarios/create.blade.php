@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header w-100">
                <div class="d-flex w-100 justify-content-between">
                    <h3>Criar Funcionário</h3>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('funcionarios.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group  mt-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group  mt-2">
                        <label for="salario">Salário</label>
                        <input type="number" class="form-control" id="salario" name="salario" required>
                    </div>
                    <div class="form-group d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Funcionario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
