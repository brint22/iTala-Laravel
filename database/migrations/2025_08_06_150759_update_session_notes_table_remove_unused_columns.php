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
        Schema::table('session_notes', function (Blueprint $table) {
            // Tanggalin ang luma
            $table->dropColumn(['session_type', 'session_date', 'session_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('session_notes', function (Blueprint $table) {
            // I-restore lang kung babalik ka sa luma (optional)
            $table->string('session_type')->nullable();
            $table->date('session_date')->nullable();
            $table->time('session_time')->nullable();
        });
    }
};
