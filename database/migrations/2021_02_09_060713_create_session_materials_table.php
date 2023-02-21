<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')
            ->references('id')
            ->on('mini_sessions');

            $table->string('file_path', 250)->nullable()->default('');
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
        Schema::dropIfExists('session_materials');
    }
}
