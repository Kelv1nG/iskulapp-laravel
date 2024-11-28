<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentSection;
use App\Models\StudentSubject;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StudentSeeder extends Seeder
{
    /// calculation is based on
    /// 10 grade levels * 2 section * 20 students per section = 400 students per academic year
    //
    /// TODO:
    /// if we have 4 years worth of data then we need additional 400 * 3 students for the people who are gonna graduate
    /// ^attempt to make seed data more realistic
    /// total unique students = 1600
    ///
    /// but for now just assign 400 fresh students per school year * 6 academic years
    const STUDENT_COUNT_PER_SCHOOL = 2400;

    const STUDENT_PER_SECTION = 20;

    public function run(): void
    {
        $schools = School::all();
        $role = Role::where('name', RoleEnum::STUDENT)->first();

        // user + student creation + academic years
        foreach ($schools as $school) {
            $users = $this->createUsers($school);
            $students = $this->createStudents($users, $role);

            self::assignSection($students, $school);
            self::assignSubjects();
        }
    }

    private function createUsers(School $school): Collection
    {
        $userRecords = [];
        $hashedPassword = Hash::make('iskulapp');

        // in memory of j dela crud
        for ($i = 1; $i <= self::STUDENT_COUNT_PER_SCHOOL; $i++) {
            $userRecords[] = [
                'email' => "student-{$i}-{$school->short_name}@example.com",
                'password' => $hashedPassword,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

        }
        User::insert($userRecords);

        $users = User::whereIn('email', array_column($userRecords, 'email'))->get();
        $this->createUserProfiles($users, $school);

        return $users;
    }

    private function createUserProfiles(Collection $users, School $school): void
    {
        $userProfiles = [];

        foreach ($users as $index => $user) {
            $userProfiles[] = UserProfile::factory()->make([
                'user_id' => $user->id,
                'first_name' => 'Student '.($index + 1),
                'last_name' => $school->short_name,
            ])->toArray();
        }

        UserProfile::insert($userProfiles);
    }

    private function createStudents($users, $role)
    {
        $students = [];

        foreach ($users as $user) {

            $students[] = Student::factory()->make([
                'user_id' => $user->id,
            ])->toArray();

            $roleAssignments[] = [
                'role_id' => $role->id,
                'model_type' => User::class,
                'model_id' => $user->id,
            ];
        }

        DB::table(config('permission.table_names.model_has_roles'))->insert($roleAssignments);
        Student::insert($students);

        return Student::whereIn('user_id', $users->pluck('id'))->get();
    }

    /// assign 20 unique students per section
    private static function assignSection($students, $school)
    {
        $sections = DB::select('
            SELECT
                sections.id AS section_id,
                academic_years.school_id AS school_id,
                academic_years.id AS academic_year_id,
                sections.name AS section_name
            FROM sections
            LEFT JOIN academic_years ON academic_years.id = sections.academic_year_id
            WHERE academic_years.school_id = ?
            ORDER BY sections.id ASC
            ', [$school->id]);

        $studentSectionRecords = [];

        $studentCount = 0;
        $sectionIndex = 0;
        $sectionMaxIndex = count($sections);

        foreach ($students as $student) {
            $studentSectionRecords[] = [
                'student_id' => $student->id,
                'section_id' => $sections[$sectionIndex]->section_id,
            ];
            $studentCount++;

            if ($studentCount == self::STUDENT_PER_SECTION) {
                $studentCount = 0;
                $sectionIndex++;

            }

            if ($sectionIndex == $sectionMaxIndex) {
                break;
            }
        }

        foreach (array_chunk($studentSectionRecords, 1000) as $chunk) {
            StudentSection::insert($chunk);
        }
    }

    private static function assignSubjects(): void
    {
        $results = DB::select('
            SELECT DISTINCT
                subject_classes.subject_year_id AS subject_year_id,
                student_sections.student_id AS student_id
            FROM subject_classes
            LEFT JOIN student_sections ON student_sections.section_id = subject_classes.section_id
            WHERE student_sections.student_id IS NOT NULL
            ORDER BY student_sections.student_id ASC;'
        );

        $studentSubjectRecords = [];
        foreach ($results as $result) {
            $studentSubjectRecords[] = [
                'subject_year_id' => $result->subject_year_id,
                'student_id' => $result->student_id,
            ];
        }

        foreach (array_chunk($studentSubjectRecords, 1000) as $chunk) {
            StudentSubject::insert($chunk);
        }
    }
}
