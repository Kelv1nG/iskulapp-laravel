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
        if (app()->environment() !== 'production') {
            $this->call([
                AdminSeeder::class,

                SchoolSeeder::class,
                AcademicYearSeeder::class,
                GradeLevelSeeder::class,
                SectionSeeder::class,
                SubjectSeeder::class,
                SubjectYearSeeder::class,

                TeacherSeeder::class,
                SubjectClassSeeder::class,
                StudentSeeder::class,

                AssessmentSeeder::class,
                AssessmentQuestionSeeder::class,
                AssessmentQuestionAnswerKeySeeder::class,
                AssessmentTakerSeeder::class,

                AssessmentStudentReportSeeder::class,
                AssessmentStudentAnswerSeeder::class,

                StudentAttendanceSeeder::class,

                OauthClientSeeder::class,
            ]);
        }
    }
}
