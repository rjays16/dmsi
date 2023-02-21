<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditFieldsRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->foreignId('mem_type_id')->nullable()->change();
            $table->foreignId('chapter_id')->nullable()->change();
            $table->string('prc_number')->change();
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
            //
        });
    }
}
