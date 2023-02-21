<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsStampedToSponsorStamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsor_stamps', function (Blueprint $table) {
            $table->boolean('is_stamped')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsor_stamps', function (Blueprint $table) {
            $table->dropColumn('is_stamped');
        });
    }
}
