<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('contacts', function (Blueprint $table) {
        //     $table->id(); // ID auto-incrémenté
        //     $table->string('adresse'); // Adresse de l'entreprise
        //     $table->string('telephone_1');
        //     $table->string('telephone_2')->nullable();
        //     $table->string('email');
        //     $table->string('heures_ouverture_1');
        //     $table->string('twitter_url')->nullable();
        //     $table->string('facebook_url')->nullable();
        //     $table->string('youtube_url')->nullable();
        //     $table->string('linkedin_url')->nullable();
        //     $table->string('logo')->nullable(); // Stocker uniquement le nom du fichier
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
