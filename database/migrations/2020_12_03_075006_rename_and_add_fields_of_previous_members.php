<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAndAddFieldsOfPreviousMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('previous_members', function (Blueprint $table) {
            Schema::rename('previous_members', 'pcr_members');
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
            //
        });
    }
}
