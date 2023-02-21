<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditStartUrlCapacity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mini_sessions', function (Blueprint $table) {
            $table->string('start_url', 1000)->change()->nullable()->default('');
            $table->string('join_url', 1000)->change()->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mini_sessions', function (Blueprint $table) {
            //
        });
    }
}
