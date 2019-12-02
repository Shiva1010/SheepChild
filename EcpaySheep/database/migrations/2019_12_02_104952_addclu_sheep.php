<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddcluSheep extends Migration
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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
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
            $table->dropColumn('email');
            $table->timestamp('email_verified_at')->nullable();
        });
    }
}
