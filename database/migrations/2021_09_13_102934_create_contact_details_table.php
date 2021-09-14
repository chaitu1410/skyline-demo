<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_details', function (Blueprint $table) {
            $table->id();
            $table->string('CutomerSupportContactNumber', 50)->default('+91 9765499835');
            $table->string('SalesContactNumber', 50)->default('+91 9765499823');
            $table->string('OtherQueryContactNumber', 50)->default('+91 9765499835');

            $table->string('CutomerSupportEmail', 50)->default('info@skylinegroup.co.in');
            $table->string('SalesEmail', 50)->default('sales@skylinegroup.co.in');
            $table->string('OtherQueryEmail', 50)->default('sanketskyline12@gmail.com');

            $table->text('OfficeAddress')->default('Skyline Distributors\n* Plot No. 24 Gut No. 23, Sai Udyog Nagari, Near Cosmo Film,\nWaluj, MIDC\nAurangabad, Maharashtra, 431136\nINDIA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_details');
    }
}
