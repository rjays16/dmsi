<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrainingInstitutionToPcrMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pcr_members', function (Blueprint $table) {
            $table->string('training_ins', 900)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pcr_members', function (Blueprint $table) {
            $table->dropColumn('training_ins');
        });
    }
}
