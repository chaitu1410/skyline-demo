<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('status')->default(config('constants.orderStatus.ordered'));
            $table->boolean('isPaid')->default(false);
            $table->string('razorpayOrderId')->nullable();
            $table->string('razorpayPaymentId')->nullable();
            $table->boolean('isDelivered')->default(false);
            $table->date('estimatedDate')->default(Carbon::now()->addDays(20));
            $table->dateTime('delivered_at')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
