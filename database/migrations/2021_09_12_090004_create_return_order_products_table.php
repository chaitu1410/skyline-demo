<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_order_products', function (Blueprint $table) {
            $table->id();
            $table->string('reason', 255);
            $table->text('detailedReason');
            $table->text('reply')->nullable();

            $table->foreignId('return_order_id')
                ->constrained('return_orders')
                ->onDelete('cascade');

            $table->foreignId('order_product_id')
                ->nullable()
                ->constrained('order_products')
                ->onDelete('set null');

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
        Schema::dropIfExists('return_order_products');
    }
}
