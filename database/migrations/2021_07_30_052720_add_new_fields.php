<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_banners', function (Blueprint $table) {
            //
            $table->string('page_type')->nullable();
            $table->string('text_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main_banners', function (Blueprint $table) {
            //
            $table->dropColumn('page_type');
            $table->dropColumn('text_color');
        });
    }
}
