<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   //unnecessary table
        Schema::create('details', function (Blueprint $table) {
            $table->id()->nullable();
            $table->foreignId('drivers_id')->nullable()
                ->references('id')->on('drivers')
            ->cascadeOnDelete();
            $table->string('home_address',100)->nullable();
            $table->string('first_name',30);    //user
            $table->string('last_name',30);     //user
            $table->char('license_type',1)->nullable();
            $table->dateTime('last_trip_date')->nullable();
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
        Schema::dropIfExists('details');
    }
}
