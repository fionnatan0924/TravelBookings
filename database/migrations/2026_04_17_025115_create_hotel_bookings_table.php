<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('hotel_bookings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('hotel_id')->constrained();
    $table->date('check_in');
    $table->date('check_out');
    $table->integer('guests');
    $table->decimal('total_price', 10, 2);
    $table->string('booking_reference')->unique();
    $table->enum('status', ['confirmed', 'cancelled'])->default('confirmed');
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
        Schema::dropIfExists('hotel_bookings');
    }
}
