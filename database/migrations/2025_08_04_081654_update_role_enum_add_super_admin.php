<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Note: This is MySQL-specific
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'rpm', 'super_admin') DEFAULT 'rpm'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'rpm') DEFAULT 'rpm'");
    }
};
