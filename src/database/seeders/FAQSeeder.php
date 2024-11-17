<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    public function run()
    {
        FAQ::create([
            'question' => 'What is Laravel?',
            'answer' => 'Laravel is a PHP framework for web artisans.',
        ]);

        FAQ::create([
            'question' => 'How do I install Laravel?',
            'answer' => 'You can install Laravel via Composer by running "composer create-project --prefer-dist laravel/laravel project-name".',
        ]);

        FAQ::create([
            'question' => 'What is Eloquent?',
            'answer' => 'Eloquent is the ORM (Object-Relational Mapper) in Laravel that allows you to interact with your database using PHP syntax.',
        ]);

    }
}
