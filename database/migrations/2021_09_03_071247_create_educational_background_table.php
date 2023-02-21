<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalBackgroundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_background', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pcr_member_id');
            $table->foreign('pcr_member_id')->references('id')->on('pcr_members');
            $table->string('medicine')->nullable();
            $table->string('med_graduation')->nullable();
            $table->string('residency')->nullable();
            $table->string('res_graduation')->nullable();
            $table->string('specialty')->nullable();
            $table->string('spec_graduation')->nullable();
            $table->string('specialty_society')->nullable();
            $table->string('specialty_society_graduation')->nullable();
            $table->string('subspecialty')->nullable();
            $table->string('subspecialty_society')->nullable();
            $table->string('subspecialty_society_induction')->nullable();
            $table->string('master_education')->nullable();
            $table->string('master_education_school')->nullable();
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
        Schema::dropIfExists('educational_background');
    }
}
