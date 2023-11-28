@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Veículo</h1>

        <form id="editVeiculoForm" action="{{ route('veiculos.update', $veiculo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="marca_id">Marca:</label>
                <select class="form-control" name="marca_id" id="marca_id">
                    <option value=""> - </option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}" {{ $veiculo->marca_id == $marca->id ? 'selected' : '' }}>
                            {{ $marca->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="modelo_id">Modelo:</label>
                <select class="form-control" name="modelo_id" id="modelo_id">
                    <option value=""> - </option>
                    @foreach ($modelos as $modelo)
                        <option value="{{ $modelo->id }}" {{ $veiculo->modelo_id == $modelo->id ? 'selected' : '' }}>
                            {{ $modelo->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="ano">Ano:</label>
                <input type="text" class="form-control" name="ano" id="ano" value="{{ $veiculo->ano }}">
            </div>

            <div class="form-group">
                <label for="cor">Cor:</label>
                <input type="text" class="form-control" name="cor" id="cor" value="{{ $veiculo->cor }}">
            </div>

            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="text" class="form-control" name="preco" id="preco" value="{{ $veiculo->preco }}">
            </div>

            <div class="form-group">
                <label for="imagens">Imagens:</label>
                <input type="file" name="imagens[]" accept="image/*" multiple>
                <br>
            </div>

            <button id="editVeiculoButton" type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        <div id="previewContainer">
            @foreach($veiculo->imagens as $imagem)
                <img src="{{ Storage::disk('s3')->url($imagem->imagem_path) }}" width="100" height="100" />
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function (e) {
            $('#editVeiculoForm').submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (response) { 
                        // Sucesso ao atualizar o Veículo
                        alert('Veículo atualizado com sucesso!');
                        window.location.href = "{{ route('veiculos.index') }}";
                    },
                    error: function (xhr, status, error) {
                        // Falha ao atualizar o Veículo
                        var errorMessage = xhr.responseJSON.message;
                        alert('Erro ao atualizar Veículo: ' + errorMessage);
                    }
                });
            });

            // Para aparecer apenas os modelos especificos para cada Marca de carro
            $('#marca_id').change(function () {
                console.log('oi')
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
            $('#marca_id').change();

            $('input[name="imagens[]"]').on('change', function () {
                // Exibir pré-visualização das novas imagens selecionadas
                $('#previewContainer').empty();

                for (var i = 0; i < this.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#previewContainer').append('<img src="' + e.target.result + '" width="100" height="100" />');
                    };
                    reader.readAsDataURL(this.files[i]);
                }
            });
        });
    </script>
@endsection
