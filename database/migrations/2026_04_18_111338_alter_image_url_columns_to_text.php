<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE destinations MODIFY image_url TEXT');
        DB::statement('ALTER TABLE attractions MODIFY image_url TEXT');
    }

    public function down()
    {
        DB::statement('ALTER TABLE destinations MODIFY image_url VARCHAR(255)');
        DB::statement('ALTER TABLE attractions MODIFY image_url VARCHAR(255)');
    }
};
