<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->boolean('content_approved')->default(false);
            $table->boolean('newly_edited')->default(false);
            $table->string('content_comment', 900)->nullable()->default('No comment');
            $table->string('contact_email', 100)->nullable();
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
            $table->dropColumn('content_approved');
            $table->dropColumn('newly_edited');
            $table->dropColumn('content_comment');
            $table->dropColumn('contact_email');
        });
    }
}
