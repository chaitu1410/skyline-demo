<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('customerName', 255);
            $table->string('company', 255);
            $table->string('email', 255);
            $table->string('mobile', 10);
            $table->text('requirement');
            $table->string('pincode', 6);
            $table->string('city', 255);
            $table->string('clientQuotationFile')->nullable();
            $table->text('reply')->nullable();
            $table->string('adminQuotationFile')->nullable();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
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
        Schema::dropIfExists('quotes');
    }
}
