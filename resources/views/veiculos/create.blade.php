@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cadastro de Veículo</h1>
        
        <form id="createVeiculoForm" action="{{ route('veiculos.store') }}" method="POST">
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
                <label for="modelo_id">Modelo:</label>
                <select class="form-control" name="modelo_id" id="modelo_id">
                  <option value="">Selecione uma marca</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="ano">Ano:</label>
                <input type="text" class="form-control" name="ano" id="ano" value="{{ old('ano') }}">
            </div>
            
            <div class="form-group">
                <label for="cor">Cor:</label>
                <input type="text" class="form-control" name="cor" id="cor" value="{{ old('cor') }}">
            </div>

            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="text" class="form-control" name="preco" id="preco" value="{{ old('preco') }}">
            </div>
            
            <button id="createVeiculoButton" type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Função de envio do formulário
            $('#createVeiculoForm').submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // Sucesso ao salvar o veículo
                        alert('Veículo criado com sucesso!');
                        window.location.href = "{{ route('veiculos.index') }}";
                    },
                    error: function (xhr, status, error) {
                        // Falha ao salvar o veículo
                        var errorMessage = xhr.responseJSON.message;
                        alert('Erro ao cadastrar veículo: ' + errorMessage);
                    }
                });
            });

            // Para aparecer apenas os modelos especificos para cada Marca de carro
            $('#marca_id').change(function () {
                var marcaId = $(this).val();
                $('#modelo_id').empty();

                if (marcaId) {
                    // Requisição AJAX para buscar os modelos relacionados à marca selecionada
                    $.ajax({
                        url: '/veiculos/busca-modelos/' + marcaId,
                        type: 'GET',
                        success: function (data) {
                            if (data.length > 0) {
                                // Se houver modelos, preenche a dropdown de modelos com os resultados da request
                                $.each(data, function (key, value) {
                                    $('#modelo_id').append('<option value="' + value.id + '">' + value.nome + '</option>');
                                });
                            } else {
                                // Se não houver modelos, exibe uma mensagem no dropdown
                                $('#modelo_id').append('<option value="">Não há modelos dessa marca</option>');
                            }
                        }
                    });
                } else {
                    // Se nenhuma marca é selecionada, exibir uma mensagem padrão no dropdown
                    $('#modelo_id').append('<option value="">Selecione uma marca</option>');
                }
            });
        });
    </script>
@endsection
