<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // -------------------------------------------------------
        // Courses
        // -------------------------------------------------------
        $bsit = Course::create([
            'name'        => 'BSIT',
            'description' => 'Bachelor of Science in Information Technology',
        ]);

        $bscs = Course::create([
            'name'        => 'BSCS',
            'description' => 'Bachelor of Science in Computer Science',
        ]);

        // -------------------------------------------------------
        // Users
        // password for ALL accounts: password
        // -------------------------------------------------------

        // User 1 — owns the sample students below
        $owner = User::create([
            'name'     => 'Juan dela Cruz',
            'email'    => 'juan@example.com',
            'password' => Hash::make('password'),
        ]);

        // User 2 — a second user for testing the 403 block
        $other = User::create([
            'name'     => 'Maria Santos',
            'email'    => 'maria@example.com',
            'password' => Hash::make('password'),
        ]);

        // -------------------------------------------------------
        // Students (owned by Juan)
        // -------------------------------------------------------
        Student::create([
            'user_id'            => $owner->id,
            'course_id'          => $bsit->id,
            'full_name'          => 'Pedro Reyes',
            'professional_title' => 'Full-Stack Developer',
            'email'              => 'pedro@example.com',
            'phone'              => '09171234567',
            'address'            => 'Quezon City, Metro Manila',
            'bio'                => 'Passionate developer with experience in Laravel and Vue.js.',
            'skills'             => 'PHP, Laravel, Vue.js, MySQL, Tailwind CSS',
            'github_url'         => 'https://github.com',
            'linkedin_url'       => 'https://linkedin.com',
        ]);

        Student::create([
            'user_id'            => $owner->id,
            'course_id'          => $bscs->id,
            'full_name'          => 'Ana Lim',
            'professional_title' => 'Data Analyst',
            'email'              => 'ana@example.com',
            'phone'              => '09189876543',
            'address'            => 'Makati City, Metro Manila',
            'bio'                => 'Aspiring data analyst focused on Python and machine learning.',
            'skills'             => 'Python, Pandas, NumPy, SQL, Tableau',
            'github_url'         => 'https://github.com',
            'linkedin_url'       => 'https://linkedin.com',
        ]);

        // Student owned by Maria — Juan cannot edit this one
        Student::create([
            'user_id'            => $other->id,
            'course_id'          => $bsit->id,
            'full_name'          => 'Carlo Villanueva',
            'professional_title' => 'UI/UX Designer',
            'email'              => 'carlo@example.com',
            'phone'              => '09201112222',
            'address'            => 'Cebu City, Cebu',
            'bio'                => 'Creative designer who loves building intuitive user interfaces.',
            'skills'             => 'Figma, Adobe XD, HTML, CSS, JavaScript',
            'github_url'         => 'https://github.com',
            'linkedin_url'       => 'https://linkedin.com',
        ]);
    }
}
