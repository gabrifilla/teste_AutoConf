@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listagem de Modelos</h1>
        
        <form action="{{ route('modelos.index') }}" method="GET">
          @csrf
          <div class="row">
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
                <button type="button" onclick="atualizarListaModelos()" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('modelos.index') }}" class="btn btn-secondary">Limpar</a>
              </div>
            </div>
          </div>
        </form>
        
        <!-- Tabela de modelos -->
        <table id="tabela-modelos" class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Modelo</th>
              <th>Marca</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($modelos as $mod)
              <tr>
                <td>{{ $mod->id }}</td>
                <td>{{ $mod->nome }}</td>
                <td>{{ $mod->marca->nome ?? 'N/A' }}</td>
                <td>
                  <a href="{{ route('modelos.edit', ['modelo' => $mod->id]) }}" class="btn btn-primary">Editar</a>
                  <form action="{{ route('modelos.destroy', $mod->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este veículo?')">Excluir</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        
        {{ $modelos->links() }}
    </div>
@endsection

<script>

  function construirLinhaTabela(modelo) {
    return (
      '<tr>' +
      '<td>' + modelo.id + '</td>' +
      '<td>' + modelo.nome + '</td>' +
      '<td>' + modelo.marca.nome + '</td>' +
      '<td>' +
      '<a href="/modelos/' + modelo.id + '/editar" class="btn btn-primary">Editar</a>' +
      '<form action="/modelos/' + modelo.id + '" method="POST" style="display: inline-block;">' +
      '@csrf' +
      '@method("DELETE")' +
      '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir este modelo?\')">Excluir</button>' +
      '</form>' +
      '</td>' +
      '</tr>'
    );
  }

  function atualizarListaModelos() {
    var marcas = $('#filtro-marcas').val();
    var modelos = $('#filtro-modelos').val();

    var url = '/modelos/filtrar?&filtro-marcas=' + encodeURIComponent(marcas) +
              '&filtro-modelos=' + encodeURIComponent(modelos);

    $.ajax({
      url: url,
      type: 'GET',
      success: function(response) {
        var tableBody = $('#tabela-modelos tbody');
        tableBody.empty();

        if (response.length === 0) {
          tableBody.html('<tr><td colspan="7">Nenhum modelo encontrado</td></tr>');
          return;
        }

        $.each(response, function(index, modelo) {
          var row = construirLinhaTabela(modelo);
          tableBody.append(row);
        });
      },
      error: function(xhr) {
        console.log(xhr.responseText);
      }
    });
  }
</script>
