<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('zoom_email', 100)->nullable()->default('');
            $table->string('zoom_key', 300)->nullable()->default('');
            $table->string('zoom_secret', 300)->nullable()->default('');
            $table->string('room_name', 300)->nullable()->default('');
            $table->boolean('is_occupied')->nullable()->default(false);
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
        Schema::dropIfExists('rooms');
    }
}
