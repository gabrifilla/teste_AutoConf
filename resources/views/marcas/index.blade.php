@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listagem de Marcas</h1>
        
        <form action="{{ route('marcas.index') }}" method="GET">
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
            <div class="col-md-3 mt-4">
              <div class="form-group">
                <button type="button" onclick="atualizarListaMarcas()" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('marcas.index') }}" class="btn btn-secondary">Limpar</a>
              </div>
            </div>
          </div>
        </form>
        
        <!-- Tabela de marcas -->
        <table id="tabela-marcas" class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Marca</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($marcas as $marc)
              <tr>
                <td>{{ $marc->id }}</td>
                <td>{{ $marc->nome }}</td>
                <td>
                  <a href="{{ route('marcas.edit', ['marca' => $marc->id]) }}" class="btn btn-primary">Editar</a>
                  <form action="{{ route('marcas.destroy', $marc->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta Marca?')">Excluir</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        
        {{ $marcas->links() }}
    </div>
@endsection

<script>

  function construirLinhaTabela(marca) {
    return (
      '<tr>' +
      '<td>' + marca.id + '</td>' +
      '<td>' + marca.nome + '</td>' +
      '<td>' + marca.marca.nome + '</td>' +
      '<td>' +
      '<a href="/marcas/' + marca.id + '/editar" class="btn btn-primary">Editar</a>' +
      '<form action="/marcas/' + marca.id + '" method="POST" style="display: inline-block;">' +
      '@csrf' +
      '@method("DELETE")' +
      '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir este veículo?\')">Excluir</button>' +
      '</form>' +
      '</td>' +
      '</tr>'
    );
  }

  function atualizarListaMarcas() {
    var marcas = $('#filtro-marcas').val();
    var marcas = $('#filtro-marcas').val();

    var url = '/marcas/filtrar?&filtro-marcas=' + encodeURIComponent(marcas) +
              '&filtro-marcas=' + encodeURIComponent(marcas);

    $.ajax({
      url: url,
      type: 'GET',
      success: function(response) {
        var tableBody = $('#tabela-marcas tbody');
        tableBody.empty();

        if (response.length === 0) {
          tableBody.html('<tr><td colspan="7">Nenhum marca encontrado</td></tr>');
          return;
        }

        $.each(response, function(index, marca) {
          var row = construirLinhaTabela(marca);
          tableBody.append(row);
        });
      },
      error: function(xhr) {
        console.log(xhr.responseText);
      }
    });
  }
</script>
