<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('vehicle_no', 30);
            $table->string('registered_owner', 30);
            $table->float('loading_capacity', 100);
            $table->float('tare_weight' ,100);
            $table->string('make' , 50);
            $table->string('model_no', 30);
            $table->string('engine_no', 50);
            $table->string('chassis_no', 50);
            $table->string('passing_territory', 50);
            $table->date('fitness_upto');
            $table->date('permit_upto');
            $table->string('driver_name', 50);
            $table->string('license_no', 50);
            $table->string('group', 50);
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
        //
    }
}
