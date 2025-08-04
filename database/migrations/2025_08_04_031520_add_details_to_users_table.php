<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('middle_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['male', 'female', 'non-binary', 'prefer not to say'])->nullable();
            $table->string('contact_number')->nullable();
            $table->string('license_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'middle_name',
                'birthdate',
                'gender',
                'contact_number',
                'license_number',
            ]);
        });
    }
};
