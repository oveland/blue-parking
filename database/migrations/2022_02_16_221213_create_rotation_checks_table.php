<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRotationChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rotation_checks', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start');
            $table->timestamp('finish')->nullable();
            $table->double('start_latitude')->nullable();
            $table->double('start_longitude')->nullable();
            $table->string('finish_latitude')->nullable();
            $table->string('finish_longitude')->nullable();
            $table->boolean('completed');

            $table->unsignedBigInteger('parking_zone_id')->nullable();
            $table->foreign('parking_zone_id')->references('id')->on('parking_zones');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('rotation_check_id')->nullable();
            $table->foreign('rotation_check_id')->references('id')->on('rotation_checks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('rotation_check_id');
        });

        Schema::dropIfExists('rotation_checks');
    }
}
