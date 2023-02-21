<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiniSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mini_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('topic', 100)->nullable()->default('');
            $table->string('zoom_email', 100)->nullable()->default('');
            $table->string('zoom_key', 250)->nullable()->default('');
            $table->string('zoom_secret', 250)->nullable()->default('');
            $table->string('start_time', 100)->nullable()->default('');
            $table->string('end_time', 100)->nullable()->default('');
            $table->string('room_name', 100)->nullable()->default('');
            $table->date('scheduled_date')->nullable();
            $table->string('join_url', 500)->nullable()->default('');
            $table->string('start_url', 500)->nullable()->default('');
            $table->timestamps();

            $table->unsignedBigInteger('sponsor_id');
            $table->foreign('sponsor_id')
            ->references('id')
            ->on('sponsors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mini_sessions');
    }
}
