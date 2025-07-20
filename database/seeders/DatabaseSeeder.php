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
        // Create staff user
        $staff = User::create([
            'name' => 'Staff Admin',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'department' => 'Administration',
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
                'content' => 'We are excited to welcome all students back for the new academic year. Please check your schedules and attend the orientation session on Monday.',
                'category_id' => 1,
                'user_id' => $staff->id,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Annual Sports Meet Registration Open',
                'content' => 'Registration for the annual sports meet is now open. Students can register for various events including athletics, swimming, and team sports.',
                'category_id' => 4,
                'user_id' => $staff->id,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'New Computer Lab Facilities',
                'content' => 'We are pleased to announce the opening of our new computer lab with state-of-the-art equipment. The lab will be available for students from 8 AM to 8 PM.',
                'category_id' => 5,
                'user_id' => $staff->id,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Student Council Elections',
                'content' => 'Student council elections will be held next week. All students are encouraged to participate and vote for their representatives.',
                'category_id' => 2,
                'user_id' => $staff->id,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Library Extended Hours',
                'content' => 'The library will now be open until 10 PM during exam periods to provide students with additional study time.',
                'category_id' => 3,
                'user_id' => $staff->id,
                'is_published' => false,
            ],
        ];

        foreach ($newsData as $newsItem) {
            News::create($newsItem);
        }

        // Create sample enquiries
        $enquiriesData = [
            [
                'name' => 'Jane Doe',
                'email' => 'jane.doe@example.com',
                'subject' => 'Course Registration Query',
                'message' => 'I am having trouble registering for the Advanced Mathematics course. Can someone help me with this?',
                'status' => 'pending',
                'user_id' => $student->id,
            ],
            [
                'name' => 'Mike Smith',
                'email' => 'mike.smith@example.com',
                'subject' => 'Library Card Application',
                'message' => 'I would like to apply for a library card. What documents do I need to submit?',
                'status' => 'in_progress',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'subject' => 'Sports Equipment Availability',
                'message' => 'I want to know if the gym equipment is available for student use and what the timings are.',
                'status' => 'resolved',
            ],
        ];

        foreach ($enquiriesData as $enquiryItem) {
            Enquiry::create($enquiryItem);
        }
    }
}
