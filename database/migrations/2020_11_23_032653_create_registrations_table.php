<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('contact_number');
            $table->integer('prc_number');
            $table->string('address');
            $table->string('username');
            $table->dateTime('last_login');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
