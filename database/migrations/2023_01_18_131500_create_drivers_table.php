<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()
                ->references('id')->on('users')
            ->cascadeOnDelete();
            $table->string('id_number',20)->unique();
            $table->string('phone_number',20)->unique();
            $table->string('home_address',100)->nullable();
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
        Schema::dropIfExists('drivers');
    }
}
