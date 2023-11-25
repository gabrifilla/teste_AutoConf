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
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
        ]);
    
        $marca = Marca::create([
            'nome' => $validatedData['nome'],
        ]);

        return redirect()->route('veiculos.index')->with('success', 'Marca criada com sucesso!');
    }
}
