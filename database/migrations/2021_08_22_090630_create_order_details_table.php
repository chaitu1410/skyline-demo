<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('customerName');
            $table->string('customerContact');
            $table->string('customerContact2')->nullable();
            $table->string('gst')->nullable();;
            $table->string('company')->nullable();;
            $table->double('amount', 10, 2);
            $table->double('totalGst', 10, 2);
            $table->double('totalDiscount', 10, 2);
            $table->double('deliveryCharge', 10, 2);
            $table->double('payableAmount', 10, 2);
            $table->string('pincode');
            $table->string('town');
            $table->string('area');
            $table->string('houseNumber');
            $table->string('landmark');
            $table->foreignId('order_id')
                ->constrained('orders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
