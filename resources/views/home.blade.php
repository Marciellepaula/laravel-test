@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h3 class="fw-bold mb-4">Baixar Relatório</h3>
                        <form action="{{ route('buscar') }}" method="post">
                            @csrf
                            <fieldset>
                                <legend class="fw-bold">Filtros:</legend>
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
                                                <input class="form-control" id="data_inicial" type="date"
                                                    name="data_inicial" min="2024-01-01" max="{{ now()->format('Y-m-d') }}"
                                                    value="{{ request()->data_inicial }}">
                                            </div>
                                            <div class="flex-fill">
                                                <label class="fw-bold" for="data_final">Data Final:</label>
                                                <input class="form-control" id="data_final" type="date" name="data_final"
                                                    min="2024-01-01" max="{{ now()->format('Y-m-d') }}"
                                                    value="{{ request()->data_final }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <a id="exportar" class="btn btn-primary" href="#">
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
                <div class="card mt-4">
                    <div class="card-header">Lista de Funcionários</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Salario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($funcionarios as $funcionario)
                                    <tr>
                                        <td>{{ $funcionario->nome }}</td>
                                        <td>{{ $funcionario->email }}</td>
                                        <td>{{ $funcionario->salario }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3">Nenhum Funcionário encontrado!</td>
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
