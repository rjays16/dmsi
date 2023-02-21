<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatedEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_events', function (Blueprint $table) {
            $table->id();
            $table->string('link_text', 150)->nullable()->default('');
            $table->string('link_photo', 250)->nullable()->default('');
            $table->string('link_url', 900)->nullable()->default('');
            $table->integer('event_type')->unsigned()->nullable()->default(12);
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
        Schema::dropIfExists('related_events');
    }
}
