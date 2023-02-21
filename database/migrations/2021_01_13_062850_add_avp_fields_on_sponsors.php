<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvpFieldsOnSponsors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->text('avp1')->nullable();
            $table->text('avp2')->nullable();
            $table->text('avp3')->nullable();
            $table->text('avp4')->nullable();
            $table->text('avp5')->nullable();
            $table->text('avp6')->nullable();
            $table->text('avp7')->nullable();
            $table->text('avp8')->nullable();
            $table->text('avp9')->nullable();
            $table->text('avp10')->nullable();
            $table->string('product_intro', 900)->nullable()->default('');
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
            $table->dropColumn('avp1');
            $table->dropColumn('avp2');
            $table->dropColumn('avp3');
            $table->dropColumn('avp4');
            $table->dropColumn('avp5');
            $table->dropColumn('avp6');
            $table->dropColumn('avp7');
            $table->dropColumn('avp8');
            $table->dropColumn('avp9');
            $table->dropColumn('avp10');
            $table->dropColumn('product_intro');
        });
    }
}
