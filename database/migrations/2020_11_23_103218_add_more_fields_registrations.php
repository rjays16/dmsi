<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->foreignId('reg_type_id')->constrained('registration_types');
            $table->foreignId('mem_type_id')->constrained('membership_types');
            $table->foreignId('non_type_id')->constrained('non_member_types');
            $table->foreignId('chapter_id')->constrained('pcr_chapters');
            $table->foreignId('prc_id')->constrained('prc_numbers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            //
        });
    }
}
