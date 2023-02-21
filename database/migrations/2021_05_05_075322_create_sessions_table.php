<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('topic', 100)->nullable()->default('');
            $table->string('event_name', 100)->nullable()->default('');
            $table->string('start_time', 100)->nullable()->default('');
            $table->integer('duration_hours')->unsigned()->nullable()->default(1);
            $table->date('scheduled_date')->nullable();
            $table->string('join_url', 999)->nullable()->default('');
            $table->string('start_url', 999)->nullable()->default('');
            $table->string('description', 500)->nullable()->default('');
            $table->integer('max_user')->unsigned()->nullable()->default(12);
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
        Schema::dropIfExists('sessions');
    }
}
