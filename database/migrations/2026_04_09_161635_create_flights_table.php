<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('origin');
            $table->string('destination');
            $table->date('departure_date');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->string('airline');
            $table->enum('cabin_class', ['economy', 'premium', 'business', 'first']);
            $table->decimal('price', 10, 2);
            $table->integer('available_seats')->default(50);
            $table->string('duration')->default('2h 30m');
            $table->string('origin_terminal')->default('T1');
            $table->string('destination_terminal')->default('T2');
            $table->string('baggage')->default('Checked baggage 20 kg');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};