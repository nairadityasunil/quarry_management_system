<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PurchaseIn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_in', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('lease', 30);
            $table->string('purch_company', 30);
            $table->string('vehicle_no', 10);
            $table->string('supplier', 30);
            $table->string('item', 30);
            $table->float('tare_weight', 100);
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
