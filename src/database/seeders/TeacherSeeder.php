<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\AcademicYear;
use App\Models\School;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class TeacherSeeder extends Seeder
{
    /// calculation is based on
    /// 6 subjects per grade level * 2 section * 10 / ( 3 subjects * 2 section per teacher) = 120 / 6
    const TEACHER_COUNT_PER_SCHOOL = 20;

    public function run(): void
    {
        $schools = School::all();
        $role = Role::where('name', RoleEnum::TEACHER)->first();

        /// user-teacher creation + academic years
        foreach ($schools as $school) {
            $users = $this->createUsers($school);
            $teachers = $this->createTeachers($users, $role);
            self::assignAcademicYears($teachers, $school);
        }

        self::assignSubjects();
    }

    private function createUsers(School $school): Collection
    {
        $userRecords = [];
        $hashedPassword = Hash::make('iskulapp');

        // in memory of ms laravel
        for ($i = 1; $i <= self::TEACHER_COUNT_PER_SCHOOL; $i++) {
            $userRecords[] = [
                'email' => "teacher-{$i}-{$school->short_name}@example.com",
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
                'first_name' => 'Teacher '.($index + 1),
                'last_name' => $school->short_name,
            ])->toArray();
        }

        UserProfile::insert($userProfiles);
    }

    private function createTeachers(Collection $users, Role $role): Collection
    {
        $teachers = [];
        $roleAssignments = [];

        foreach ($users as $user) {
            $teachers[] = Teacher::factory()->make([
                'user_id' => $user->id,
            ])->toArray();

            $roleAssignments[] = [
                'role_id' => $role->id,
                'model_type' => User::class,
                'model_id' => $user->id,
            ];
        }

        DB::table(config('permission.table_names.model_has_roles'))->insert($roleAssignments);
        Teacher::insert($teachers);

        return Teacher::whereIn('user_id', $users->pluck('id'))->get();
    }

    /*
    * assign all academic years of a school to a teacher
    */
    private static function assignAcademicYears(Collection $teachers, School $school): void
    {
        $academicYearIds = AcademicYear::where('school_id', $school->id)->pluck('id');
        foreach ($teachers as $teacher) {
            $teacher->academicYears()->sync($academicYearIds);
        }
    }

    private static function assignSubjects(): void
    {
        /// this assigns 3 subject to a teacher so that each subject
        /// offered by school is occupied and each teacher is occupied and have same workload

        /// filtering flag is used to filter assigned subjects in multiples of 3 (since 3 is assigned per teacher)
        $results = DB::select('
            WITH teacher_subject_combinations AS (
                SELECT DISTINCT
                    teacher_year.teacher_id,
                    academic_years.school_id,
                    subjects.id AS subject_id,
                    (teacher_year.teacher_id * 3) AS filtering
                FROM teacher_year
                LEFT JOIN academic_years
                    ON academic_years.id = teacher_year.academic_year_id
                LEFT JOIN subjects
                    ON academic_years.school_id = subjects.school_id
                ORDER BY teacher_year.teacher_id ASC
            )

            SELECT
                t.teacher_id,
                t.subject_id,
				subject_years.id AS subject_year_id
            FROM teacher_subject_combinations AS t
			RIGHT JOIN subject_years ON subject_years.subject_id = t.subject_id
            WHERE t.subject_id BETWEEN (t.filtering - 2) AND t.filtering;
            ');

        $teacherSubjectRecords = [];
        foreach ($results as $result) {
            $teacherSubjectRecords[] = [
                'teacher_id' => $result->teacher_id,
                'subject_year_id' => $result->subject_year_id,
            ];
        }

        foreach (array_chunk($teacherSubjectRecords, 1000) as $chunk) {
            TeacherSubject::insert($chunk);
        }
    }
}
