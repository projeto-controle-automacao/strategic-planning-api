<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubFrasesHasPillars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_frases_has_pillars', function (Blueprint $table) {
            $table->unsignedBigInteger('pillar_id');
            $table->unsignedBigInteger('sub_frase_id');
            $table->timestamps();

            $table->foreign('pillar_id')->references('id')->on('pillars');
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
        Schema::dropIfExists('sub_frases_has_pillars');
    }
}
