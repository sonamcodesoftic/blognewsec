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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->numeric('is_admin')->nullable();

            $table->string('lname');
            $table->string('phone')->nullable();
            $table->string('ip');
            $table->string('browser');
            $table->string('country');
            $table->string('device');
            $table->string('key')->nullable();
            $table->string('token')->nullable();
            $table->string('countrycode')->nullable();
            $table->string('fcmtoken'->nullable());
            $table->string('address')->nullable();
            $table->string('profile')->nullable();
            $table->string('state')->nullable();
            $table->string('nationality')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('userrole')->nullable();
            $table->string('status')->nullable();

            
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
