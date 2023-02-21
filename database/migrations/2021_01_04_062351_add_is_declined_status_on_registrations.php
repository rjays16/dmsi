<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDeclinedStatusOnRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->boolean('is_declined')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn('is_declined');
        });
    }
}
