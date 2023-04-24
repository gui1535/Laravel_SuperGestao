<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoDetalhesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_detalhes', function (Blueprint $table) {
            //colunas
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->decimal('comprimento', 10, 2)->nullable();
            $table->decimal('largura', 10, 2)->nullable();
            $table->decimal('peso', 10, 2)->nullable();
            $table->decimal('altura', 10, 2)->nullable();
            $table->decimal('preco_venda', 10, 2)->nullable();
            $table->decimal('estoque_minimo', 10, 2)->nullable();
            $table->decimal('estoque_maximo', 10, 2)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
            //constraint
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->unique('produto_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_detalhes');
    }
}
