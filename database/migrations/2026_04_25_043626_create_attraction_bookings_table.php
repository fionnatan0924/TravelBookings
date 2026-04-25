<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attraction_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('attraction_id')->constrained()->onDelete('cascade');
            $table->integer('number_of_people');
            $table->decimal('total_price', 10, 2);
            $table->string('booking_reference')->unique();
            $table->enum('status', ['confirmed', 'cancelled', 'pending'])->default('confirmed');
            $table->timestamp('booking_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attraction_bookings');
    }
};