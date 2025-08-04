<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'staff' to the enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('student', 'admin', 'staff') DEFAULT 'student'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'staff' from the enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('student', 'admin') DEFAULT 'student'");
    }
};
