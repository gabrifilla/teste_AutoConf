@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Modelos</h1>

        <form id="editModeloForm" action="{{ route('modelos.update', $modelo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome do Modelo:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="{{ $modelo->nome }}">
            </div>

            <div class="form-group">
                <label for="marca_id">Marca:</label>
                <select class="form-control" name="marca_id" id="marca_id">
                    <option value=""> - </option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}" {{ $modelo->marca_id == $marca->id ? 'selected' : '' }}>
                            {{ $marca->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
 
            <button id="editModeloButton" type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>

    <script>
        $(document).ready(function (e) {
            $('#editModeloForm').submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (response) { 
                        // Sucesso ao atualizar o Modelo
                        alert('Modelo atualizado com sucesso!');
                        window.location.href = "{{ route('modelos.index') }}";
                    },
                    error: function (xhr, status, error) {
                        // Falha ao atualizar o Modelo
                        var errorMessage = xhr.responseJSON.message;
                        alert('Erro ao atualizar Modelo: ' + errorMessage);
                    }
                });
            });
        });
    </script>
@endsection
