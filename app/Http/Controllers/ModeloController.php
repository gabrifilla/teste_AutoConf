<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class ModeloController extends Controller
{
    public function create()
    {
        $marcas = Marca::all();

        return view('modelos.create', compact('marcas'));
    }

    public function index(Request $request)
    {   
        $marcas = Marca::all();

        $modelos = Modelo::with('marca')->paginate(10);
        return view('modelos.index', compact('modelos', 'marcas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'marca_id' => 'required|integer',
        ]);
    
        $modelo = Modelo::create([
            'nome' => $validatedData['nome'],
            'marca_id' => $validatedData['marca_id'],
        ]);

        return redirect()->route('modelos.index')->with('success', 'Modelo criado com sucesso!');
    }

    public function edit(Modelo $modelo)
    {
        $marcas = Marca::all();

        $modelo->load('marca');

        return view('modelos.edit', compact('marcas', 'modelo'));
    }

    public function update(Request $request, Modelo $modelo)
    {
        $request->validate([
            'nome' => 'required',
            'marca_id' => 'required',
        ]);
    
        // Atualiza os outros campos do modelo
        $modelo->update([
            'nome' => $request->input('nome'),
            'marca_id' => $request->input('marca_id'),
        ]);
    
        return redirect()->route('modelos.index')->with('success', 'Modelo atualizado com sucesso.');
    }

    public function destroy(Modelo $modelo)
    {
        // Exclusão do Modelo
        $modelo->delete();

        return redirect()->route('modelos.index')->with('success', 'Modelo excluído com sucesso!');
    }

}
