<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drivers_id')
               ->references('id')->on('drivers')
            ->cascadeOnDelete();
            $table->string('license_plate_number',10);
            $table->string('vehicle_make',20);
            $table->string('vehicle_model',20);
            $table->year('year');
            $table->boolean('insured')->default(false);
            $table->dateTime('service_date')->nullable();
            $table->integer('capacity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
