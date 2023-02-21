<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoolInPreviousMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('previous_members', function (Blueprint $table) {
            $table->boolean('is_trainee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('previous_members', function (Blueprint $table) {
            $table->dropColumn('is_trainee');
        });
    }
}
