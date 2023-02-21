<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsor_products', function (Blueprint $table) {
            $table->unsignedBigInteger('sponsor_id');
            $table->foreign('sponsor_id')
            ->references('id')
            ->on('sponsors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsor_products', function (Blueprint $table) {
            $table->dropColumn('sponsor_id');
        });
    }
}
