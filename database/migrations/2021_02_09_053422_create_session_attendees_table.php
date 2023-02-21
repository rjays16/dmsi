<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_attendees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reg_id');
            $table->foreign('reg_id')
            ->references('id')
            ->on('registrations');


            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')
            ->references('id')
            ->on('mini_sessions');
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
        Schema::dropIfExists('session_attendees');
    }
}
