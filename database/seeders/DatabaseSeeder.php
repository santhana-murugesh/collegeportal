<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\News;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'department' => 'Administration',
        ]);

        // Create staff user
        $staff = User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'department' => 'Academic Affairs',
        ]);

        // Create student user
        $student = User::create([
            'name' => 'John Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'student_id' => 'STU001',
            'department' => 'Computer Science',
        ]);

        // Create categories
        $categories = [
            ['name' => 'Academic', 'description' => 'Academic announcements and updates'],
            ['name' => 'Events', 'description' => 'Upcoming events and activities'],
            ['name' => 'General', 'description' => 'General announcements'],
            ['name' => 'Sports', 'description' => 'Sports and athletics news'],
            ['name' => 'Technology', 'description' => 'Technology and IT updates'],
        ];

        foreach ($categories as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'slug' => \Illuminate\Support\Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
                'is_active' => true,
            ]);
        }

        // Create sample news articles
        $newsData = [
            [
                'title' => 'Welcome to the New Academic Year',
                'content' => 'We are excited to welcome all students to the new academic year. Please check your schedules and attend orientation sessions.',
                'category_id' => 1,
                'user_id' => $admin->id,
                'is_published' => true,
            ],
            [
                'title' => 'Annual Sports Meet Registration',
                'content' => 'Registration for the annual sports meet is now open. All students are encouraged to participate.',
                'category_id' => 4,
                'user_id' => $admin->id,
                'is_published' => true,
            ],
            [
                'title' => 'New Computer Lab Facilities',
                'content' => 'The new computer lab with latest technology is now open for students. Book your slots in advance.',
                'category_id' => 5,
                'user_id' => $admin->id,
                'is_published' => true,
            ],
        ];

        foreach ($newsData as $newsItem) {
            News::create($newsItem);
        }

        // Create sample enquiries
        $enquiriesData = [
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'subject' => 'Course Registration Query',
                'message' => 'I need help with course registration for the upcoming semester.',
                'status' => 'pending',
            ],
            [
                'name' => 'Mike Smith',
                'email' => 'mike@example.com',
                'subject' => 'Library Access',
                'message' => 'I am having trouble accessing the online library resources.',
                'status' => 'in_progress',
            ],
        ];

        foreach ($enquiriesData as $enquiryData) {
            Enquiry::create($enquiryData);
        }
    }
}
