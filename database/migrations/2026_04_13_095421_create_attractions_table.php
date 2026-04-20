<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // e.g. "Petronas Twin Towers Skybridge"
            $table->foreignId('destination_id')->constrained()->onDelete('cascade'); // links to destinations
            $table->decimal('rating', 3, 1)->default(0); // 8.8
            $table->integer('reviews')->default(0);      // 51508
            $table->decimal('price', 10, 2);             // discounted price
            $table->decimal('original_price', 10, 2)->nullable(); // original price
            $table->string('discount_text')->nullable();  // "17% off"
            $table->string('booking_text')->nullable();   // "Book now for tomorrow"
            $table->string('image_url')->nullable();      // image path or URL
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attractions');
    }
};