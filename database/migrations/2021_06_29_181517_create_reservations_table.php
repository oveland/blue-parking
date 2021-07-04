<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->timestamp('start')->useCurrent();
            $table->timestamp('end')->useCurrent();
            $table->timestamp('hold_start')->useCurrent();
            $table->timestamp('hold_end')->useCurrent();
            $table->boolean('active')->default(true);

            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('reservation_type_id');

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
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
        Schema::dropIfExists('reservations');
    }
}
