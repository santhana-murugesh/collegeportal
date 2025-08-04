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
        // First, modify the enum to include 'admin'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('student', 'staff', 'admin') DEFAULT 'student'");
        
        // Then, update existing 'staff' records to 'admin'
        DB::table('users')->where('role', 'staff')->update(['role' => 'admin']);
        
        // Finally, remove 'staff' from the enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('student', 'admin') DEFAULT 'student'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, add 'staff' back to the enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('student', 'staff', 'admin') DEFAULT 'student'");
        
        // Then, revert 'admin' back to 'staff'
        DB::table('users')->where('role', 'admin')->update(['role' => 'staff']);
        
        // Finally, remove 'admin' from the enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('student', 'staff') DEFAULT 'student'");
    }
};
