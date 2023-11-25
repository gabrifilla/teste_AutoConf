@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cadastro de Usuário</h1>
        
        <form id="createUserForm" action="{{ route('users.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
            </div>
            
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
            </div>
            
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha:</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>
            
            <button id="createUserButton" type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#createUserForm').submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // Sucesso ao salvar o usuário
                        alert('Usuário criado com sucesso!');
                        window.location.href = "{{ route('users.index') }}";
                    },
                    error: function (xhr, status, error) {
                        // Falha ao salvar o usuário
                        var errorMessage = xhr.responseJSON.message;
                        alert('Erro ao cadastrar usuário: ' + errorMessage);
                    }
                });
            });
        });
    </script>
@endsection
