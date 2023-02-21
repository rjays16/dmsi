<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLobbyVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lobby_videos', function (Blueprint $table) {
            $table->id();
            $table->string('video_name', 200)->nullable()->default('');
            $table->string('video_url', 990)->nullable()->default('');
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
        Schema::dropIfExists('lobby_videos');
    }
}
