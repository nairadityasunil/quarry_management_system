<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoreIn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_in', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('item_name' , 100);
            $table->string('seller' , 50);
            $table->string('unit' ,30);
            $table->float('quantity' ,50);
            $table->double('price_per_unit' ,50);
            $table->double('total_value' , 100);
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
