@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Marcas</h1>

        <form id="editMarcaForm" action="{{ route('marcas.update', $marca->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome da Marca:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="{{ $marca->nome }}">
            </div>

            <button id="editMarcaButton" type="submit" class="btn btn-primary">Atualizar</button>
        </form>

    </div>

    <script>
        $(document).ready(function (e) {
            $('#editMarcaForm').submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (response) { 
                        // Sucesso ao atualizar o Marca
                        alert('Marca atualizada com sucesso!');
                        window.location.href = "{{ route('marcas.index') }}";
                    },
                    error: function (xhr, status, error) {
                        // Falha ao atualizar o Marca
                        var errorMessage = xhr.responseJSON.message;
                        alert('Erro ao atualizar Marca: ' + errorMessage);
                    }
                });
            });
        });
    </script>
@endsection
