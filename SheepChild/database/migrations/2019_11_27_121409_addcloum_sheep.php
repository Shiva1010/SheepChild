<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddcloumSheep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheep', function (Blueprint $table)
        {
            $table->unsignedInteger('lucky')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('sheep', function (Blueprint $table) {
            $table->dropColumn('lucky');
        });
    }
}
