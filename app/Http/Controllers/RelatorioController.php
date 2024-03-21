<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{

    public function index(Request $request)
    {
        $funcionarios = Funcionario::query()
            ->when($request->filled('nome'), function ($query) use ($request) {
                $query->where('nome', 'like', "%{$request->nome}%");
            })
            ->when($request->filled('email'), function ($query) use ($request) {
                $query->where('cargo', 'like', "%{$request->email}%");
            })
            ->when($request->filled('salario'), function ($query) use ($request) {
                $query->where('salario', $request->salario);
            })
            ->get();


        return view('home', compact('funcionarios'));
    }

    public function baixarRelatorio(Request $request)
    {




        return view('');
    }
}
