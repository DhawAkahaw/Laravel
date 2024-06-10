<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeTransfertLignesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_transfert_lignes', function (Blueprint $table) {
            $table->id();
            $table->string('adsl_num');
            $table->string('new_num_tel');
            $table->boolean('state_line_prop');
            $table->string('nic');
            $table->string('current_address');
            $table->string('new_address');
            $table->string('prev_num');
            $table->string('gsm');
            $table->string('state');
            $table->string('message');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demande__transfert__lignes');
    }
}
