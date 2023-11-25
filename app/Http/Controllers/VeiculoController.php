<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Marca;
use App\Models\Modelo;

use Illuminate\Http\Request;


class VeiculoController extends Controller
{
    public function index(Request $request)
    {   
        $marcas = Marca::all();
        $modelos = Modelo::all();

        $veiculos = Veiculo::with('marca', 'modelo')->paginate(10);
        return view('veiculos.index', compact('veiculos', 'marcas', 'modelos'));
    }

    public function create()
    {
        $marcas = Marca::all();
        $modelos = Modelo::all();

        return view('veiculos.create', compact('marcas', 'modelos'));
    }
    
    public function edit(Veiculo $veiculo)
    {
        $marcas = Marca::all();
        $modelos = Modelo::all();

        $veiculo->load('marca', 'modelo');

        return view('veiculos.edit', compact('veiculo', 'marcas', 'modelos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'marca_id' => 'required|integer',
            'modelo_id' => 'required|integer',
            'ano' => 'required|integer',
            'cor' => 'required|string|max:255',
            'preco' => 'required|numeric',
        ]);
    
        $veiculo = Veiculo::create([
            'marca_id' => $validatedData['marca_id'],
            'modelo_id' => $validatedData['modelo_id'],
            'ano' => $validatedData['ano'],
            'cor' => $validatedData['cor'],
            'preco' => $validatedData['preco'],
        ]);

        return redirect()->route('veiculos.index')->with('success', 'Veículo criado com sucesso!');
    }

    public function update(Request $request, $veiculo)
    {
        $validatedData = $request->validate([
            'marca_id' => 'required|integer',
            'modelo_id' => 'required|integer',
            'ano' => 'required|integer',
            'cor' => 'required|string|max:255',
            'preco' => 'required|numeric',
        ]);
    
        $veiculo = Veiculo::findOrFail($veiculo);
        $veiculo->marca_id = $validatedData['marca_id'];
        $veiculo->modelo_id = $validatedData['modelo_id'];
        $veiculo->ano = $validatedData['ano'];
        $veiculo->cor = $validatedData['cor'];
        $veiculo->preco = $validatedData['preco'];
    
        $veiculo->save();
    
        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso.');
    }

    public function destroy(Veiculo $veiculo)
    {
        // Exclusão do Veículo
        $veiculo->delete();

        return redirect()->route('veiculos.index')->with('success', 'Veículo excluído com sucesso!');
    }

    public function buscaModelos($marcaId)
    {
        $modelos = Modelo::where('marca_id', $marcaId)->get();
        return response()->json($modelos);
    }

    public function filtrar(Request $request)
    {
        $preco = $request->input('filtro-preco');
        $marca = $request->input('filtro-marcas');
        $modelo = $request->input('filtro-modelos');

        // Inicialize a consulta no banco de dados
        $query = Veiculo::with(['marca', 'modelo']);

        // Adicione condições aos filtros
        if ($preco !== null) {
            $query->where('preco', '>=', $preco);
        }

        if ($marca !== null) {
            $query->where('marca_id', $marca);
        }

        if ($modelo !== null) {
            $query->where('modelo_id', $modelo);
        }

        // Execute a consulta e obtenha os resultados
        $veiculos = $query->get();

        return response()->json($veiculos);
    }
}
