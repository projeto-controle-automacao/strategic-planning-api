<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->unsignedBigInteger('user_id');
            $table->string('razao_social')->nullable(true);
            $table->string('nome_fantasia');
            $table->string('cnpj')->nullable(true);;
            $table->text('missao')->nullable(true);
            $table->text('visao')->nullable(true);
            $table->text('valores')->nullable(true);
            $table->timestamps();
            //$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
