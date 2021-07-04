<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('identity', 20)->nullable();
            $table->string('phone', 15)->default('11111111');
            $table->string('address', 255)->nullable();

            $table->softDeletes();
            $table->unique(['email', 'deleted_at']);

            $table->dropUnique(['email']);
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
            $table->unique('email');

            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('identity');
            $table->dropColumn('username');
        });
    }
}
