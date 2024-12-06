<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('idMenu'); 
            $table->string('libelleMenu')->nullable();
            $table->string('titre_page')->nullable();
            $table->string('controller')->nullable();
            $table->string('route')->nullable();
            $table->string('Topmenu_id')->nullable();
            $table->string('num_ordre')->nullable();
            $table->string('order_ss')->nullable();
            $table->string('iconee')->nullable();
            $table->string('element_menu')->nullable();
            $table->string('statut')->nullable();
            $table->unsignedBigInteger('user_action')->nullable();
            $table->string('action_save')->nullable();
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
        Schema::dropIfExists('menus');
    }
}
