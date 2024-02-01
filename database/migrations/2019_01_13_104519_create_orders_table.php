<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->float('order_total', 10, 2);
            $table->string('customer_name',50);
            $table->string('customer_city',50);
            $table->string('customer_area',50);
            $table->string('customer_address',100);
            $table->string('customer_email',100);
            $table->string('customer_phone_number', 36)->nullable();
            $table->tinyInteger('order_status')->default('0');
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
        Schema::dropIfExists('orders');
    }
}
