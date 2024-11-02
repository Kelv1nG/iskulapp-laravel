<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StudentSeeder extends Seeder
{
    const STUDENT_EXAMPLE_MAIL = 'juandelacrud@example.com';

    const STUDENT_EXAMPLE_PASSWORD = 'juandelacrud';

    const STUDENT_FIRST_NAME = 'Juan';

    const STUDENT_LAST_NAME = 'De la Crud';

    public function run(): void
    {
        $user = User::factory()->create([
            'email' => self::STUDENT_EXAMPLE_MAIL,
            'password' => Hash::make(self::STUDENT_EXAMPLE_PASSWORD),
        ]);

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);
        $role = Role::where('name', RoleEnum::STUDENT)->first();
        $user->assignRole($role);

        UserProfile::factory()->create([
            'user_id' => $user->id,
            'first_name' => self::STUDENT_FIRST_NAME,
            'last_name' => self::STUDENT_LAST_NAME,
        ]);

        $this->generateStudentYears($student);
    }

    private function generateStudentYears($student): void
    {
        $academicYearIds = AcademicYear::pluck('id');

        $student->academicYears()->syncWithoutDetaching($academicYearIds);
    }
}
