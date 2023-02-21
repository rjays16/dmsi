<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_samples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sponsor_id')->constrained('sponsors');
            $table->string('banner_file', 990)->nullable();
            $table->string('logo_file', 990)->nullable();
            $table->string('facebook_url', 990)->nullable();
            $table->string('website', 990)->nullable();
            $table->string('video_url1', 990)->nullable();
            $table->string('video_url2', 990)->nullable();
            $table->string('video_url3', 990)->nullable();
            $table->string('bannerstand1', 990)->nullable();
            $table->string('bannerstand2', 990)->nullable();
            $table->string('bannerstand3', 990)->nullable();
            $table->string('bannerstand4', 990)->nullable();
            $table->string('magazinestand1', 990)->nullable();
            $table->string('magazinestand2', 990)->nullable();
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
        Schema::dropIfExists('sponsor_samples');
    }
}
