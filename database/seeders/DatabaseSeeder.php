<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
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
        //$user = User::factory()->count(5)->create();

        //Student::factory()->count(5)->create();
        //User::factory()->times(10)->create();

        /*Student::factory()->times(10)->create()->each(function ($student) {
            $student->user()->sync(
                Student::all()->random(3)
            );
        });*/

        Student::factory()->times(15)->create();
        Course::factory()->times(8)->create()->each(function($course){
            $course->students()->sync(
                Student::all()->random(3)
            );
        });
    }
}
