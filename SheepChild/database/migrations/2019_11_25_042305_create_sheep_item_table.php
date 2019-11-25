<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheepItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheep_item', function (Blueprint $table) {
            $table->primary(['sheep_id', 'item_id']);
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('sheep_id');
            $table->integer('price');
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
        Schema::dropIfExists('sheep_items');
    }
}
