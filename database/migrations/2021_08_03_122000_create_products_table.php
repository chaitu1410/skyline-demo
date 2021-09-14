<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255)->nullable();
            $table->string('name', 200)->nullable();
            $table->double('mrp', 10, 2)->nullable();
            $table->double('discount', 5, 2)->nullable();
            $table->double('gst', 5, 2)->nullable();
            $table->double('sellingPrice', 10, 2)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('manual', 255)->nullable();
            $table->boolean('stock')->nullable();
            $table->boolean('verified')->nullable();
            $table->boolean('topPick')->nullable();
            $table->text('description')->nullable();
            $table->string('countryOfOrigin', 64)->nullable();

            $table->foreignId('brand_id')
                ->constrained('brands')
                ->onDelete('cascade');

            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('cascade');

            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained('subcategories')
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
        Schema::dropIfExists('products');
    }
}
