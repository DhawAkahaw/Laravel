<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();
            $table->string('Offre');
            $table->string('Service');
            $table->string('Category');
            $table->string('Motif_rec');
            $table->string('Image');
            $table->string('gsm');
            $table->string('Message');
            $table->string('Reference');
            $table->unsignedBigInteger('gsm');
            $table->foreign('gsm')->references('gsm')->on('clients')->onDelete('cascade');      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reclamations');
    }
}
