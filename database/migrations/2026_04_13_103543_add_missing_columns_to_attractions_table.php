<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->text('description')->nullable()->after('image_url');
            $table->string('schedule_info')->nullable()->after('description');
            $table->integer('duration_minutes')->nullable()->after('schedule_info');
            $table->integer('max_tickets_per_booking')->default(10)->after('duration_minutes');
            $table->boolean('peak_season_surcharge')->default(false)->after('max_tickets_per_booking');
            $table->decimal('peak_season_multiplier', 3, 2)->default(1.2)->after('peak_season_surcharge');
        });
    }

    public function down()
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->dropColumn(['description', 'schedule_info', 'duration_minutes', 'max_tickets_per_booking', 'peak_season_surcharge', 'peak_season_multiplier']);
        });
    }
};