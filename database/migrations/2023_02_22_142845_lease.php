<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lease extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('lease_no' , 50);
            $table->string('address' ,100);
            $table->float('lease_area' , 50);
            $table->string('measure' , 30);
            $table->string('leaseholder' , 50);
            $table->float('lease_ton_limit' , 50);
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
