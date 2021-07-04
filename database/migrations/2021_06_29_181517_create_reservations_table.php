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

            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->timestamp('hold_start')->useCurrent();
            $table->timestamp('hold_end')->nullable();
            $table->boolean('active')->default(false);

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
