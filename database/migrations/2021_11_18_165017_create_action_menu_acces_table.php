<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionMenuAccesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_menu_acces', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('Menu')->nullable();
            $table->unsignedBigInteger('Role')->nullable();
            $table->unsignedBigInteger('ActionMenu')->nullable();
            $table->unsignedBigInteger('statut')->nullable();
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
        Schema::dropIfExists('action_menu_acces');
    }
}
