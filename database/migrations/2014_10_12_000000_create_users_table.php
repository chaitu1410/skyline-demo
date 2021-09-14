<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('image')->default('defaultuser.png');
            $table->string('mobile', 15)->unique();
            $table->string('mobile2', 15)->nullable();
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('gstNumber', 20)->nullable();
            $table->string('company', 255)->nullable();
            $table->boolean('isAdmin')->default(false);
            $table->boolean('active')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
