<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldToSamples extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsor_samples', function (Blueprint $table) {
            $table->string('wall_background', 250)->nullable()->default('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsor_samples', function (Blueprint $table) {
            $table->dropColumn('wall_background');
        });
    }
}
