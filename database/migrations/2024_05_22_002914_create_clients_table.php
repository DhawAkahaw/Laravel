<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('rue');
            $table->string('gouvernorat');
            $table->string('delegation');
            $table->string('localite');
            $table->string('ville');
            $table->string('code_postal');
            $table->string('tel');
            $table->string('gsm');
            $table->string('login');
            $table->string('password');
            $table->string('picture');
            $table->unique('code_Client');
            $table->string('type_Client');
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
        Schema::dropIfExists('clients');
    }
}
