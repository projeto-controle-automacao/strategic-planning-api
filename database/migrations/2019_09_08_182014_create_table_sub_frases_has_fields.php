<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubFrasesHasFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_frases_has_fields', function (Blueprint $table) {
            $table->unsignedBigInteger('field_id');
            $table->unsignedBigInteger('sub_frase_id');
            $table->timestamps();

            $table->foreign('field_id')->references('id')->on('fields');
            $table->foreign('sub_frase_id')->references('id')->on('sub_frases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_frases_has_fields');
    }
}
