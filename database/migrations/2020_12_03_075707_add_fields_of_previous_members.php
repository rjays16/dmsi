<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsOfPreviousMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pcr_members', function (Blueprint $table) {
            $table->foreignId('mem_type_id')->constrained('membership_types')->nullable();
            $table->foreignId('chapter_id')->constrained('pcr_chapters')->nullable();
            $table->foreignId('prc_id')->constrained('prc_numbers')->nullable();
            $table->string('address', 900);
            $table->string('fb_account', 900)->nullable();
            $table->boolean('registered_in_convention')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->boolean('in_good_standing')->default(0);
            $table->string('photo_path', 900)->nullable();
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
            $table->dropColumn(['mem_type_id', 'chapter_id', 'prc_id', 'address', 'fb_account',
                'registered_in_convention', 'is_approved', 'in_good_standing', 'photo_path'
            ]);
        });
    }
}
