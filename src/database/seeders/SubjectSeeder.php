<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['name' => 'math'],
            ['name' => 'physical_education'],
            ['name' => 'religion'],
            ['name' => 'english'],
            ['name' => 'music'],
        ];

        Subject::insert($subjects);
    }
}
