<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertismentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisments', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150)->nullable()->default('text');
            $table->string('body_text', 900)->nullable()->default('text');
            $table->integer('order')->nullable()->default(12);
            $table->string('file_path', 300)->nullable()->default('');
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
        Schema::dropIfExists('advertisments');
    }
}
