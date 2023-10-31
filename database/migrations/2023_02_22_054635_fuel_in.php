<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FuelIn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_in', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('bill_no' , 50);
            $table->string('seller' , 50);
            $table->string('fuel_type' , 30);
            $table->float('quantity' , 100);
            $table->float('rate' , 100);
            $table->float('amount' , 100);
            $table->string('vehicle_no' , 50);
            $table->string('driver_name' , 50);
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
