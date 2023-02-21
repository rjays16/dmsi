<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoothNameFieldToSponsor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
            ->references('id')
            ->on('sponsor_type');
            $table->string('booth_name', 500)->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->dropColumn('booth_name');
            $table->dropColumn('type_id');
        });
    }
}
