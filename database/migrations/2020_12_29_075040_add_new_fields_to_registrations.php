<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('prof_suffix', 100)->nullable()->default('');
            $table->string('prof_suffix_other', 100)->nullable()->default('');
            $table->string('reg_type_other', 100)->nullable()->default('');
            $table->string('type_of_payment', 100)->nullable()->default('');
            $table->timestamp('date_of_payment')->nullable();
            $table->timestamp('date_of_expiration')->nullable();
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
            $table->dropColumn('prof_suffix');
            $table->dropColumn('prof_suffix_other');
            $table->dropColumn('reg_type_other');
            $table->dropColumn('type_of_payment');
            $table->dropColumn('date_of_payment');
            $table->dropColumn('date_of_expiration');
        });
    }
}
