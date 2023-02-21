<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditForeignRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->foreignId('prc_id')->nullable()->change();
            $table->foreignId('non_type_id')->nullable()->change();
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
