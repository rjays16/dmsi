<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('country', 100)->nullable()->default('blank');
            $table->string('state', 100)->nullable()->default('blank');
            $table->string('city', 100)->nullable()->default('blank');
            $table->string('zip_code', 100)->nullable()->default('blank');
            $table->string('payment_file_path', 999)->nullable()->default('none');
            $table->string('prefix_name', 100)->nullable()->default('');
            $table->string('suffix_name', 100)->nullable()->default('');

            $table->string('address')->nullable()->default('blank')->change();
            $table->foreignId('mem_type_id')->nullable()->default(0)->change();
            $table->foreignId('non_type_id')->nullable()->default(0)->change();
            $table->foreignId('chapter_id')->nullable()->default(0)->change();
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
            $table->dropColumn('country');
            $table->dropColumn('state');
            $table->dropColumn('city');
            $table->dropColumn('zip_code');
            $table->dropColumn('payment_file_path');
            $table->dropColumn('prefix_name');
            $table->dropColumn('suffix_name');
        });
    }
}
