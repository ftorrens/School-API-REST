<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Student::factory()->times(15)->create();
        Course::factory()->times(8)->create()->each(function($course){
            $course->students()->sync(
                Student::all()->random(3)
            );
        });
    }
}
