<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Update the ENUM definition (user must not be in use, or this will fail)
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'Registered Psychometrician', 'super_admin') DEFAULT 'Registered Psychometrician'");

        // Step 2: Update any users that still have 'user' as role to 'Registered Psychometrician'
        DB::table('users')
            ->where('role', 'user')
            ->update(['role' => 'Registered Psychometrician']);
    }

    public function down(): void
    {
        // Roll back: revert ENUM
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'rpm', 'super_admin') DEFAULT 'rpm'");

        // Optional: revert 'Registered Psychometrician' to 'user'
        DB::table('users')
            ->where('role', 'Registered Psychometrician')
            ->update(['role' => 'user']);
    }
};
