@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listagem de Usuários</h1>
        
        <!-- Formulário de filtros -->
        <form action="{{ route('users.index') }}" method="GET">
          @csrf
          <div class="row">
            <div class="mb-3">
              <a href="{{ route('users.create') }}" class="btn btn-primary">Cadastrar</a> <!-- Botão de cadastro de usuário -->
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="filtro-nome">Nome:</label>
                <input type="text" class="form-control" name="filtro-nome" id="filtro-nome" value="{{ request('filtro-nome') }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="filtro-status">Status:</label>
                <select class="form-control" name="filtro-status" id="filtro-status">
                  <option value="">Todos</option>
                  <option value="1" {{ request('filtro-status') == '1' ? 'selected' : '' }}>Ativos</option>
                  <option value="0" {{ request('filtro-status') == '0' ? 'selected' : '' }}>Inativos</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <button type="button" onclick="atualizarListaUsuarios()" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Limpar</a>
              </div>
            </div>
          </div>
        </form>
        
        <!-- Tabela de usuários -->
        <table id="tabela-usuarios" class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">Editar</a>
                  <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        
        {{ $users->links() }}
    </div>
@endsection

<script>
  function atualizarListaUsuarios() {
    var nome = $('#filtro-nome').val();
    var status = $('#filtro-status').val();

    // Montar a URL com os filtros de pesquisa
    var url = '/usuarios/filtrar?filtro-nome=' + encodeURIComponent(nome) + '&filtro-status=' + encodeURIComponent(status);
    console.log(url);

    $.ajax({
      url: url,
      type: 'GET',
      success: function(response) {
        // Atualizar a tabela de usuários com os dados filtrados
        var tableBody = $('#tabela-usuarios tbody');
        tableBody.empty();

        $.each(response, function(index, user) {
          var row = '<tr>' +
            '<td>' + user.id + '</td>' +
            '<td>' + user.name + '</td>' +
            '<td>' + user.email + '</td>' +
            '<td>' +
            '<a href="/usuarios/' + user.id + '/editar" class="btn btn-primary">Editar</a>' +
            '<form action="/usuarios/' + user.id + '" method="POST" style="display: inline-block;">' +
            '@csrf' +
            '@method("DELETE")' +
            '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir este usuário?\')">Excluir</button>' +
            '</form>' +
            '</td>' +
            '</tr>';

          tableBody.append(row);
        });
      },
      error: function(xhr) {
        console.log(xhr.responseText);
      }
    });
  }
</script>
