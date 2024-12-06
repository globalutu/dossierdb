<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidcomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validcoms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('souscripteur')->nullable();
            $table->string('periode_couverte')->nullable();
            $table->string('per_preparation')->nullable();
            //$table->string('signature')->nullable();
            $table->number('police')->nullable();
            $table->number('montantcom')->nullable();
            $table->string('produit')->nullable();
            $table->string('intermediaire')->nullable();
            $table->number('base')->nullable(); 
            $table->string('datesignature')->nullable();
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
        Schema::dropIfExists('validcoms');
    }
}
