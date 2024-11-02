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
            RoleSeeder::class,
        ]);
        if(app()->environment() !== 'production') {
            $this->call([
                AdminSeeder::class,
                AcademicYearSeeder::class,
                SubjectSeeder::class,
                SubjectYearSeeder::class,
                SectionSeeder::class,

                TeacherSeeder::class,
                StudentSeeder::class,

                OauthClientSeeder::class,
            ]);
        }
    }
}
