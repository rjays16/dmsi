<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToConventionContests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('convention_contests', function (Blueprint $table) {
            $table->string('contest_video', 400)->nullable()->default('')->after('contest_pdf');
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
            $table->dropColumn('contest_type');
            $table->dropColumn('contest_video');
        });
    }
}
