<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funcionarios = Funcionario::paginate();
        return view('funcionarios.index', compact('funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request )
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

        return redirect()->route('funcionarios.index');
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
        return view('funcionarios.edit',compact('funcionarios'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $funcionarios = Funcionario::find($id);

            if (!$funcionarios) {
                return  view('funcionarios.index')->with('error', "Funcionário não encontrado");
            }
            $funcionarios->update($funcionarios);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $funcionarios = Funcionario::find($id);
        $funcionarios->delete();
        return redirect()->route('funcionarios.index');
    }
}
