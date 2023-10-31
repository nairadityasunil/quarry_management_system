<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesIn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_in', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('lease', 30);
            $table->string('selling_company', 30);
            $table->string('vehicle_no', 10);
            $table->string('driver_name' , 50);
            $table->string('customer_name', 30);
            $table->string('item', 30);
            $table->float('tare_weight' ,100);
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
