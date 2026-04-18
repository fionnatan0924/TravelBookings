<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComboPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('combo_booking_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('type', ['adult', 'child', 'infant']);
            $table->string('full_name');
            $table->date('dob');
            $table->string('nationality');
            $table->string('passport_number')->nullable();
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
        Schema::dropIfExists('combo_passengers');
    }
}
