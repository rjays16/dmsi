<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorStampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_stamps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sponsor_id')->constrained('sponsors');
            $table->foreignId('reg_id')->constrained('registrations');
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
        Schema::dropIfExists('sponsor_stamps');
    }
}
