@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card px-0">
                <div class="card-header w-100">
                    <div class="d-flex w-100 justify-content-between">
                        <h3 class="fw-bold mb-0">Dashboard</h3>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('funcionarios.create') }}" class="btn btn-sm btn-primary">
                                Criar Funcionario
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard') }}" method="get">
                        <fieldset>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="fw-bold" for="nome">Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome"
                                        placeholder="Nome">
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap gap-2">
                                        <div class="flex-fill">
                                            <label class="fw-bold" for="data_inicial">Data Inicial:</label>
                                            <input class="form-control" id="data_inicial" type="date" name="data_inicial"
                                                min="1970-01-01" max="{{ now()->format('Y-m-d') }}"
                                                value="{{ request()->data_inicial }}">
                                        </div>
                                        <div class="flex-fill">
                                            <label class="fw-bold" for="data_final">Data Final:</label>
                                            <input class="form-control" id="data_final" type="date" name="data_final"
                                                min="1970-01-01" max="{{ now()->format('Y-m-d') }}"
                                                value="{{ request()->data_final }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a id="exportar" class="btn btn-success" href="#">
                                    Exportar
                                    <i class="fas fa-file-excel"></i>
                                </a>
                                <button type="submit" class="btn btn-primary">Buscar
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
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
                            @forelse ($funcionarios as $funcionario)
                                <tr>
                                    <td>{{ $loop->index + $funcionarios->firstItem() }}
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
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('funcionarios.show', $funcionario->id) }}"
                                                class="btn btn-sm btn-primary">
                                                View
                                            </a>
                                            <a href="{{ route('funcionarios.edit', $funcionario->id) }}"
                                                class="btn btn-sm btn-warning">
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
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">Nenhum Funcionário encontrado!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $funcionarios->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#exportar').on('click', function(e) {
                e.preventDefault();
                let url = "{{ route('get-relatorios-baixar') }}";
                let data_inicial = $('#data_inicial').val();
                let data_final = $('#data_final').val();
                let nome = $('#nome').val();

                window.open(url + '?nome=' + nome + '&data_inicial=' + data_inicial + '&data_final=' +
                    data_final, '_blank');
            });
        });
    </script>
@endpush
