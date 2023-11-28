<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;

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

        return view('modelos.index', compact('marcas'));
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

}
