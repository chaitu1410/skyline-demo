<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVarientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('varients', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->nullable();
            $table->string('name', 150)->nullable();
            $table->double('mrp', 9, 2)->nullable();
            $table->double('discount', 5, 2)->nullable();
            $table->double('gst', 5, 2)->nullable();
            $table->double('sellingPrice', 9, 2)->nullable();
            $table->boolean('stock')->nullable();
            $table->foreignId('product_id')
                    ->constrained('products')
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
        Schema::dropIfExists('varients');
    }
}
