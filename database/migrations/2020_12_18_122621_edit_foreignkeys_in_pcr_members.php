<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditForeignkeysInPcrMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pcr_members', function (Blueprint $table) {
            $table->foreignId('chapter_id')->nullable()->change();
            $table->foreignId('mem_type_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pcr_members', function (Blueprint $table) {
            //
        });
    }
}
