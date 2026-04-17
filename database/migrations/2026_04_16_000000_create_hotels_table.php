<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('location', 150);
            $table->decimal('price_per_night', 10, 2);
            $table->decimal('rating', 3, 1)->default(0);
            $table->integer('reviews')->default(0);
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('destination_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotels');
    }
};
