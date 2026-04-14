<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHotelDetailsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('hotels', function (Blueprint $table) {
        $table->text('description')->nullable()->after('image');
        $table->json('gallery')->nullable()->after('description');
        $table->string('check_in_time')->default('14:00')->after('amenities');
        $table->string('check_out_time')->default('12:00')->after('check_in_time');
    });
}

public function down()
{
    Schema::table('hotels', function (Blueprint $table) {
        $table->dropColumn(['description', 'gallery', 'check_in_time', 'check_out_time']);
    });
}
}
