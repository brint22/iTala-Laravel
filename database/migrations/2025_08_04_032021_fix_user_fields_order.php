<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'first_name')) {
            $table->dropColumn('first_name');
        }
        if (Schema::hasColumn('users', 'middle_name')) {
            $table->dropColumn('middle_name');
        }
        if (Schema::hasColumn('users', 'last_name')) {
            $table->dropColumn('last_name');
        }
        if (Schema::hasColumn('users', 'name_extension')) {
            $table->dropColumn('name_extension');
        }
        if (Schema::hasColumn('users', 'birthdate')) {
            $table->dropColumn('birthdate');
        }
        if (Schema::hasColumn('users', 'gender')) {
            $table->dropColumn('gender');
        }
        if (Schema::hasColumn('users', 'contact_number')) {
            $table->dropColumn('contact_number');
        }
        if (Schema::hasColumn('users', 'license_number')) {
            $table->dropColumn('license_number');
        }
    });

    Schema::table('users', function (Blueprint $table) {
        $table->string('first_name')->after('id');
        $table->string('middle_name')->nullable()->after('first_name');
        $table->string('last_name')->after('middle_name');
        $table->string('name_extension')->nullable()->after('last_name');
        $table->date('birthdate')->nullable()->after('name_extension');
        $table->enum('gender', ['male', 'female', 'non-binary', 'prefer not to say'])->nullable()->after('birthdate');
        $table->string('contact_number')->nullable()->after('gender');
        $table->string('license_number')->nullable()->after('contact_number');
    });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'middle_name',
                'last_name',
                'name_extension',
                'birthdate',
                'gender',
                'contact_number',
                'license_number',
            ]);
        });
    }
};
