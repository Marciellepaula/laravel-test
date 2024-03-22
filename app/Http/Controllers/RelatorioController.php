<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class RelatorioController extends Controller
{
    public function baixarRelatorio(Request $request)
    {
        $funcionarios = Funcionario::query()
            ->when($request->filled('nome'), function ($query) use ($request) {
                $query->where('nome', 'like', "%{$request->nome}%");
            })
            ->when($request->filled('salario'), function ($query) use ($request) {
                $query->where('salario', $request->salario);
            })
            ->when(
                $request->data_inicial || $request->data_final,
                function ($query) use ($request) {
                    $query->when($request->data_inicial, function ($query) use ($request) {
                        $query->whereDate('created_at', '>=', $request->data_inicial);
                    });
                    $query->when($request->data_final, function ($query) use ($request) {
                        $query->whereDate('created_at', '<=', $request->data_final);
                    });
                }
            )
            ->get();

        $total = $funcionarios->sum('salario');

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf.downloadPdf', compact('funcionarios', 'total'))->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('relatorio.pdf');
    }
}
