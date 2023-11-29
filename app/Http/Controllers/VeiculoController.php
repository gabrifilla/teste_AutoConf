<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\ImagemVeiculo;

use Illuminate\Support\Facades\Storage;

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
        // Carrega as relações antes de acessá-las
        $veiculo->load('marca', 'modelo', 'imagensVeiculo');

        $marcas = Marca::all();
        $modelos = Modelo::all();

        // Agora você pode acessar as imagens diretamente da relação
        $imagens = $veiculo->imagensVeiculo;

        return view('veiculos.edit', compact('veiculo', 'marcas', 'modelos', 'imagens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'marca_id' => 'required',
            'modelo_id' => 'required',
            'ano' => 'required',
            'cor' => 'required',
            'preco' => 'required',
            'imagens.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Cria o veículo
        $veiculo = Veiculo::create([
            'marca_id' => $request->input('marca_id'),
            'modelo_id' => $request->input('modelo_id'),
            'ano' => $request->input('ano'),
            'cor' => $request->input('cor'),
            'preco' => $request->input('preco'),
        ]);
    
        // Tentativa de salvar as imagens em um bucket s3 para melhor escalonamento de sistema
        // if ($request->hasFile('imagens')) {
        //     foreach ($request->file('imagens') as $imagem) {
        //         // Gere um nome único para cada imagem
        //         $nomeUnico = uniqid().'.'.$imagem->getClientOriginalExtension();

        //         // Salve a imagem no S3 usando o método put
        //         $imagemPath = Storage::disk('s3')->put('testeautoconf/' . $nomeUnico, $imagem, 'public');

        //         // Crie o registro correspondente na tabela imagens_veiculos
        //         $veiculo->imagensVeiculo()->create([
        //             'url' => Storage::disk('s3')->url('testeautoconf/' . $nomeUnico),
        //         ]);
        //     }
        // }

        // Salva as imagens
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                // Gere um nome único para cada imagem
                $nomeUnico = uniqid().'.'.$imagem->getClientOriginalExtension();

                // Salve a imagem localmente usando o método storeAs
                $imagemPath = $imagem->storeAs('testeautoconf', $nomeUnico, 'public');

                // Crie o registro correspondente na tabela imagens_veiculos
                $veiculo->imagensVeiculo()->create([
                    'url' => $nomeUnico, // A URL é o nome do arquivo local
                ]);
            }
        }


    
        return redirect()->route('veiculos.index')->with('success', 'Veículo criado com sucesso!');
    }

    public function update(Request $request, Veiculo $veiculo)
    {
        $request->validate([
            'marca_id' => 'required',
            'modelo_id' => 'required',
            'ano' => 'required',
            'cor' => 'required',
            'preco' => 'required',
            'imagens.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Atualiza os outros campos do veículo
        $veiculo->update([
            'marca_id' => $request->input('marca_id'),
            'modelo_id' => $request->input('modelo_id'),
            'ano' => $request->input('ano'),
            'cor' => $request->input('cor'),
            'preco' => $request->input('preco'),
        ]);
    
         // Salva as imagens
         if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                // Gere um nome único para cada imagem
                $nomeUnico = uniqid().'.'.$imagem->getClientOriginalExtension();

                // Salve a imagem localmente usando o método storeAs
                $imagemPath = $imagem->storeAs('testeautoconf', $nomeUnico, 'public');

                // Crie o registro correspondente na tabela imagens_veiculos
                $veiculo->imagensVeiculo()->create([
                    'url' => $nomeUnico, // A URL é o nome do arquivo local
                ]);
            }
        }
    
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
