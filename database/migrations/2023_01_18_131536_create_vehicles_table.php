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
            $table->id()->nullable();
            $table->foreignId('drivers_id')->nullable()
               ->references('id')->on('drivers')
            ->cascadeOnDelete();
            $table->string('license_plate_number',10)->nullable();
            $table->string('vehicle_make',20)->nullable();
            $table->string('vehicle_model',20)->nullable();
            $table->year('year')->nullable();
            $table->boolean('insured')->default(false)->nullable();
            $table->dateTime('service_date')->nullable();
            $table->integer('capacity')->nullable();
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
