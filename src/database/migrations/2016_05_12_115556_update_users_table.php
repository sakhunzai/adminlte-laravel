<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('is_verified');
            $table->boolean('is_blocked');
            $table->string('verification_code',40);
            $table->boolean('terms_of_service');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('is_verified');
            $table->dropColumn('is_blocked');
            $table->dropColumn('verification_code');
            $table->dropColumn('terms_of_service');
        });
    }
}
