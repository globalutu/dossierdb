<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->bigIncrements('idUser'); 
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('sexe')->nullable();
            $table->string('tel')->nullable();
            $table->string('mail')->nullable();
            $table->string('adresse')->nullable();
            $table->string('login')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('Role')->nullable();
            $table->string('other')->nullable();
            $table->string('signature')->nullable();
            $table->string('auth')->nullable();
            $table->unsignedBigInteger('Societe')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('user_action')->nullable();
            $table->string('action_save')->nullable();
            $table->string('statut')->nullable(); 
            $table->rememberToken();
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
        Schema::dropIfExists('utilisateurs');
    }
}
