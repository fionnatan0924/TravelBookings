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
            $table->string('cabin_class');  // economy, premium, business, first
            $table->decimal('price', 10, 2);
            $table->integer('available_seats');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};