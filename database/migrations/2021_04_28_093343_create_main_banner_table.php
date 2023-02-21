<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_banners', function (Blueprint $table) {
            $table->id();
            $table->string('image_file', 990)->nullable()->default('');
            $table->string('title1', 200)->nullable()->default('');
            $table->string('title2', 200)->nullable()->default('');
            $table->string('subheading', 500)->nullable()->default('');
            $table->string('cta_button_text', 300)->nullable()->default('');
            $table->string('cta_button_url', 990)->nullable()->default('');
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
        Schema::dropIfExists('main_banners');
    }
}
