@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cadastro de Modelo</h1>
        
        <form id="createModeloForm" action="{{ route('modelos.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="marca_id">Marca:</label>
                <select class="form-control" name="marca_id" id="marca_id">
                  <option value=""> - </option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="nome">Modelo:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome') }}">
            </div>
            
            <button id="createModeloButton" type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#createModeloForm').submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // Sucesso ao salvar o Modelo
                        alert('Modelo criado com sucesso!');
                        window.location.href = "{{ route('veiculos.index') }}";
                    },
                    error: function (xhr, status, error) {
                        // Falha ao salvar o Modelo
                        var errorMessage = xhr.responseJSON.message;
                        alert('Erro ao cadastrar Modelo: ' + errorMessage);
                    }
                });
            });
        });
    </script>
@endsection
