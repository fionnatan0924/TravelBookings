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
            $table->string('name');                    
            $table->foreignId('destination_id')->constrained()->onDelete('cascade'); 
            $table->decimal('rating', 3, 1)->default(0); 
            $table->integer('reviews')->default(0);      
            $table->decimal('price', 10, 2);             
            $table->decimal('original_price', 10, 2)->nullable(); 
            $table->string('discount_text')->nullable();  
            $table->string('booking_text')->nullable();   
            $table->string('image_url')->nullable();      
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attractions');
    }
};