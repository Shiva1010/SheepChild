<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteItemSheepCloumnPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::table('item_sheep', function (Blueprint $table) {
        $table->dropColumn('price');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('item_sheep', function (Blueprint $table) {
        $table->string('price')->nullable();
    });
    }
}
