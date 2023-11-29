<?php

namespace App\Http\Controllers;

use App\Models\Marca;

use Illuminate\Http\Request;


class MarcaController extends Controller
{
    public function create()
    {
        return view('marcas.create');
    }

    public function index(Request $request)
    {   
        $marcas = Marca::paginate(10);
        return view('marcas.index', compact('marcas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
        ]);
    
        $marca = Marca::create([
            'nome' => $validatedData['nome'],
        ]);

        return redirect()->route('marcas.index')->with('success', 'Marca criada com sucesso!');
    }

    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nome' => 'required',
        ]);
    
        // Atualiza os outros campos do marca
        $marca->update([
            'nome' => $request->input('nome'),
        ]);
    
        return redirect()->route('marcas.index')->with('success', 'Marca atualizada com sucesso.');
    }

    public function destroy(Marca $marca)
    {
        // Exclusão do Marca
        $marca->delete();

        return redirect()->route('marcas.index')->with('success', 'Marca excluída com sucesso!');
    }

}
