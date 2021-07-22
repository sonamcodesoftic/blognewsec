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
            $table->string('phone');
            $table->string('ip');
            $table->string('browser');
            $table->string('country');
            $table->string('device');
            $table->string('key');
            $table->string('token');
            $table->string('countrycode');
            $table->string('fcmtoken');
            $table->string('address');
            $table->string('profile');
            $table->string('state');
            $table->string('nationality');
            $table->string('gender');
            $table->string('date_of_birth');
            $table->string('city');
            $table->string('pincode');
            $table->string('userrole');
            $table->string('status');


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
