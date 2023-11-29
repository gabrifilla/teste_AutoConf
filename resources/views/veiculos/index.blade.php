@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listagem de Veículos</h1>
        
        <form action="{{ route('veiculos.index') }}" method="GET">
          @csrf
          <div class="row">
            <div class="col-md-12 mb-3">
              <a href="{{ route('veiculos.create') }}" class="btn btn-primary">Cadastrar Veículo</a>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="filtro-preco">Preço:</label>
                <input type="text" class="form-control" name="filtro-preco" id="filtro-preco" value="{{ request('filtro-preco') }}">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="filtro-marcas">Marcas:</label>
                <select class="form-control" name="filtro-marcas" id="filtro-marcas">
                  <option value="">Todos</option>
                  @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="filtro-modelos">Modelos:</label>
                <select class="form-control" name="filtro-modelos" id="filtro-modelos">
                  <option value="">Todos</option>
                    @foreach ($modelos as $modelo)
                      <option value="{{ $modelo->id }}">{{ $modelo->nome }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3 mt-4">
              <div class="form-group">
                <button type="button" onclick="atualizarListaVeiculos()" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('veiculos.index') }}" class="btn btn-secondary">Limpar</a>
              </div>
            </div>
          </div>
        </form>
        
        <!-- Tabela de veículos -->
        <table id="tabela-veiculos" class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Ano</th>
              <th>Cor</th>
              <th>Preço</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($veiculos as $vei)
              <tr>
                <td>{{ $vei->id }}</td>
                <td>{{ $vei->marca->nome }}</td>
                <td>{{ $vei->modelo->nome }}</td>
                <td>{{ $vei->ano }}</td>
                <td>{{ $vei->cor }}</td>
                <td>R$: {{ number_format($vei->preco, 2, ',', '.') }}</td>
                <td>
                  <a href="{{ route('veiculos.edit', ['veiculo' => $vei->id]) }}" class="btn btn-primary">Editar</a>
                  <form action="{{ route('veiculos.destroy', $vei->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este veículo?')">Excluir</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        
        {{ $veiculos->links() }}
    </div>
@endsection

<script>
  function formatarMoeda(valor) {
    if (typeof valor !== 'number') {
      valor = parseFloat(valor);
    }

    if (!isNaN(valor)) {
      return 'R$ ' + valor.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    } 
    return valor;
  }

  function construirLinhaTabela(veiculo) {
    return (
      '<tr>' +
      '<td>' + veiculo.id + '</td>' +
      '<td>' + veiculo.marca.nome + '</td>' +
      '<td>' + veiculo.modelo.nome + '</td>' +
      '<td>' + veiculo.ano + '</td>' +
      '<td>' + veiculo.cor + '</td>' +
      '<td>' + formatarMoeda(veiculo.preco) + '</td>' +
      '<td>' +
      '<a href="/veiculos/' + veiculo.id + '/editar" class="btn btn-primary">Editar</a>' +
      '<form action="/veiculos/' + veiculo.id + '" method="POST" style="display: inline-block;">' +
      '@csrf' +
      '@method("DELETE")' +
      '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir este veículo?\')">Excluir</button>' +
      '</form>' +
      '</td>' +
      '</tr>'
    );
  }

  function atualizarListaVeiculos() {
    var preco = removerFormatacaoMoeda($('#filtro-preco').val());
    var marcas = $('#filtro-marcas').val();
    var modelos = $('#filtro-modelos').val();

    var url = '/veiculos/filtrar?filtro-preco=' + encodeURIComponent(preco) +
              '&filtro-marcas=' + encodeURIComponent(marcas) +
              '&filtro-modelos=' + encodeURIComponent(modelos);

    $.ajax({
      url: url,
      type: 'GET',
      success: function(response) {
        var tableBody = $('#tabela-veiculos tbody');
        tableBody.empty();

        if (response.length === 0) {
          tableBody.html('<tr><td colspan="7">Nenhum veículo encontrado</td></tr>');
          return;
        }

        $.each(response, function(index, veiculo) {
          var row = construirLinhaTabela(veiculo);
          tableBody.append(row);
        });
      },
      error: function(xhr) {
        console.log(xhr.responseText);
      }
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    // Adiciona um ouvinte de evento para o campo de preço
    document.getElementById('filtro-preco').addEventListener('blur', function (event) {
      // Obtém o valor atual do campo
      let valorCampo = event.target.value;

      // Remove caracteres não numéricos
      valorCampo = valorCampo.replace(/[^\d,]/g, '');

      // Converte para número
      let valorNumerico = parseFloat(valorCampo.replace(',', '.'));

      // Formata o número como moeda e atualiza o valor no campo
      event.target.value = formatarMoeda(valorNumerico);
    });

    function formatarMoeda(valor) {
      if (typeof valor !== 'number') {
        valor = parseFloat(valor.replace(/[^\d.,]/g, '').replace(',', '.'));
      }

      if (!isNaN(valor)) {
        return 'R$ ' + valor.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      }
      return valor;
    }

  });
  
  function removerFormatacaoMoeda(valor) {
    // Remove todos os caracteres não numéricos
    let valorNumerico = parseFloat(valor.replace(/[^\d,]/g, '').replace(',', '.'));

    // Formata o número removendo os zeros adicionais no final
    return valorNumerico.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 20 }).replace(',', '');
  }


</script>
