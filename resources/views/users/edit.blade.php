@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Usuário</h1>
        
        <form id="editUserForm" action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
            </div>
            
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
            </div>
            
            <div class="form-group">
                <label for="password">Nova Senha:</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirmar Nova Senha:</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>
            
            <button id="editUserButton" type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#editUserForm').submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // Sucesso ao atualizar o usuário
                        alert('Usuário atualizado com sucesso!');
                        window.location.href = "{{ route('users.index') }}";
                    },
                    error: function (xhr, status, error) {
                        // Falha ao atualizar o usuário
                        var errorMessage = xhr.responseJSON.message;
                        alert('Erro ao atualizar usuário: ' + errorMessage);
                    }
                });
            });
        });
    </script>
@endsection
