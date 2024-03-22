<head>
    <title>PDF Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 100%;
        }

        table {
            width: 99%;
            border-collapse: collapse;
        }

        tr,
        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot td {
            background-color: #f2f2f2;
        }

        .text-end {
            text-align: end;
        }
    </style>
</head>

<body>
    <header>
        <h1>Relatório de Funcionários</h1>
    </header>
    <main>
        <table class="table">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($funcionarios as $funcionario)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $funcionario->nome }}</td>
                        <td>{{ $funcionario->email }}</td>
                        <td>R$ {{ number_format($funcionario->salario, 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="4">Nenhum Funcionario encontrado!</td>
                    </tr>
                @endforelse

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        Total
                    </td>
                    <td colspan="2" class="text-end">
                        R$ {{ number_format($total, 2, ',', '.') }}
                    </td>
                </tr>
                <tr class="clearfix"></tr>
                <tr>
                    <td colspan="2">
                        Total de Funcionários
                    </td>
                    <td colspan="2" class="text-end">
                        {{ $funcionarios->count() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </main>

</body>
