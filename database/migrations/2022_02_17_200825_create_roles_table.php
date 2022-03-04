<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{

    const ROLES = [
        '0' => 'Default',
        '1' => 'Administrator',
        '2' => 'Operator',
        '3' => 'Client',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();

            $table->integer('uid')->unique();
            $table->string('name')->unique();
            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->index('uid');
        });

        foreach (self::ROLES as $id => $name) {
            DB::statement("INSERT INTO roles (uid, name, created_at, updated_at) VALUES ($id, '$name', current_timestamp, current_timestamp)");
        }

        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_id')->default(0)->nullable();

            $table->foreign('role_id')->references('uid')->on('roles')->onDelete('set null');
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
            $table->dropColumn('role_id');
        });

        Schema::dropIfExists('roles');
    }
}
