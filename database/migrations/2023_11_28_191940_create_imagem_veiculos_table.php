<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagemVeiculosTable extends Migration
{
    public function up()
    {
        Schema::create('imagem_veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->foreignId('veiculo_id')->constrained('veiculos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagem_veiculos');
    }
}
