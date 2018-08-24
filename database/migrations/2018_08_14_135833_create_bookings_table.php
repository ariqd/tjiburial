<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservation_id');
//            $table->integer('user_id');
            $table->string('title');
            $table->string('name');
            $table->string('email');
            $table->date('dob');
            $table->string('nationality');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->text('address');
            $table->string('phone_code');
            $table->string('phone_no');
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
        Schema::dropIfExists('bookings');
    }
}
