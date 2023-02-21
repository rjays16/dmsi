<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateConventionContestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('convention_contests', function (Blueprint $table) {
            $table->integer('rank_number')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('convention_contests', function (Blueprint $table) {
            $table->dropColumn('rank_number');
        });
    }
}
