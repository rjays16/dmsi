<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToSessionMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('session_materials', function (Blueprint $table) {
            $table->string('file_name', 100)->nullable()->default('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('session_materials', function (Blueprint $table) {
            $table->dropColumn('file_name');
        });
    }
}
