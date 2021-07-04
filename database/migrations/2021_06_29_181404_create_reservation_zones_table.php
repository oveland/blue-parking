<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_zones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('code', 45);

            $table->unsignedBigInteger('reservation_type_id');

            $table->foreign('reservation_type_id')->references('id')->on('reservation_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_zones');
    }
}
