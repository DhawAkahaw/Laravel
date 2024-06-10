<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeMigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande__migrations', function (Blueprint $table) {
            $table->id();
            $table->string('contract'); 
            $table->string('current_offre'); 
            $table->string('desired_offre'); 
            $table->string('gsm'); 
            $table->string('state'); 
            $table->string('message');
            $table->timestamps();
            $table->unsignedBigInteger('client_id'); // Define the foreign key column
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        }
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demande__migrations');
    }
}
