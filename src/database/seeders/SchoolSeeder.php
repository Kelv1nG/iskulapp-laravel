<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::insert([
            ['name' => 'Pambasang Mataas na Paaralan ng Albayanos', 'short_name' => 'PMNPNA'],
            ['name' => 'Bagong Pilipinas Elementary School', 'short_name' => 'BPES'],
        ]);
    }
}
