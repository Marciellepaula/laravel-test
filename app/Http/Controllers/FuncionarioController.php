<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $funcionarios = Funcionario::query()
            ->when($request->filled('nome'), function ($query) use ($request) {
                $query->where('nome', 'like', "%{$request->nome}%");
            })
            ->when($request->filled('salario'), function ($query) use ($request) {
                $query->where('salario', $request->salario);
            })
            ->when(
                $request->filled('data_inicial') || $request->filled('data_final'),
                function ($query) use ($request) {
                    $query->when($request->data_inicial, function ($query) use ($request) {
                        $query->whereDate('created_at', '>=', $request->data_inicial);
                    });
                    $query->when($request->data_final, function ($query) use ($request) {
                        $query->whereDate('created_at', '<=', $request->data_final);
                    });
                }
            )
            ->orderBy('updated_at', 'desc')
            ->paginate(15)
            ->appends($request->except('page'));

        return view('home', compact('funcionarios'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('funcionarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:funcionarios,email',
            'salario' => 'required|numeric|min:0'
        ]);

        $funcionario = new Funcionario([
            'nome' => $request->nome,
            'email' => $request->email,
            'salario' => $request->salario
        ]);

        $funcionario->save();

        return redirect()->route('dashboard');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('funcionarios.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $funcionarios = Funcionario::find($id);
        return view('funcionarios.edit', compact('funcionarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $funcionario = Funcionario::find($id);

        if (!$funcionario) {
            return  view('dashboard')->with('error', "Funcionário não encontrado");
        }

        $funcionario->update($request->only(
            'nome',
            'email',
            'salario'
        ));

        return redirect()->route('dashboard')->with('success', 'Funcionário atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $funcionarios = Funcionario::find($id);
        $funcionarios->delete();
        return redirect()->route('dashboard');
    }
}
