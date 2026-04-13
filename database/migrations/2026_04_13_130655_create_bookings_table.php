<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('outbound_flight_id')->constrained('flights');
            $table->foreignId('return_flight_id')->nullable()->constrained('flights');
            $table->string('booking_reference')->unique();
            $table->enum('status', ['confirmed', 'cancelled', 'completed'])->default('confirmed');
            $table->decimal('total_price', 10, 2);
            $table->enum('luggage_option', ['yes', 'no']);
            $table->decimal('luggage_cost', 10, 2)->default(0);
            $table->date('booking_date');
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('bookings'); }
};