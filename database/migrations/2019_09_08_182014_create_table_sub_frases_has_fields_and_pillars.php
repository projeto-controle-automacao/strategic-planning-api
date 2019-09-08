<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubFrasesHasFieldsAndPillars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_frases_has_fields_and_pillars', function (Blueprint $table) {
            $table->unsignedBigInteger('field_id');
            $table->unsignedBigInteger('sub_frase_id');
            $table->unsignedBigInteger('pillar_id');
            $table->timestamps();

            $table->foreign('field_id')->references('id')->on('fields');
            $table->foreign('sub_frase_id')->references('id')->on('sub_frases');
            $table->foreign('pillar_id')->references('id')->on('pillars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_frases_has_fields_and_pillars');
    }
}
