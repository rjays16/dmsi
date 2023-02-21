<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsAgainToContests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('convention_contests', function (Blueprint $table) {
            $table->string('video_url', 300)->nullable()->default('');
            $table->string('contest_type', 100)->nullable()->default('');
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
            $table->dropColumn('video_url');
            $table->dropColumn('contest_type');
        });
    }
}
