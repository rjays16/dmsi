<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToPcrMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pcr_members', function (Blueprint $table) {
            $table->integer('pma_number')->nullable();
            $table->string('place_of_practice')->nullable();
            $table->date('date_of_birth')->nullable();
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
            $table->dropColumn('pma_number');
            $table->dropColumn('place_of_practice');
            $table->dropColumn('date_of_birth');
        });
    }
}
