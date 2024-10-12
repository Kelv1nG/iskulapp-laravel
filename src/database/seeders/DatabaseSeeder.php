<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AcademicYearSeeder::class,
            SubjectSeeder::class,
            SubjectYearSeeder::class,
            AssessmentTypeSeeder::class,

            TeacherSeeder::class,
            StudentSeeder::class,
            //TODO:  ParentSeeder::class,

            OauthClientSeeder::class,
        ]);

    }
}
