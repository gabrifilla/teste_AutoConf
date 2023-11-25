@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cadastro de Marca</h1>
        
        <form id="createMarcaForm" action="{{ route('marcas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Marca:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome') }}">
            </div>
            
            
            <button id="createMarcaButton" type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#createMarcaForm').submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // Sucesso ao salvar a Marca
                        alert('Marca criada com sucesso!');
                        window.location.href = "{{ route('veiculos.index') }}";
                    },
                    error: function (xhr, status, error) {
                        // Falha ao salvar a marca
                        var errorMessage = xhr.responseJSON.message;
                        alert('Erro ao cadastrar nova marca: ' + errorMessage);
                    }
                });
            });
        });
    </script>
@endsection
