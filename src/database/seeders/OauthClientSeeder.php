<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

class OauthClientSeeder extends Seeder
{
    const TEST_CLIENT = 'test_client';

    const TEST_PERSONAL_ACCESS_CLIENT = 'test_personal_access_client';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createClient();
        $this->createPersonalAccessClient();
    }

    private function createClient(): void
    {
        Client::factory()->create([
            'name' => self::TEST_CLIENT,
        ]);
    }

    private function createPersonalAccessClient(): void
    {
        $clientRepository = new ClientRepository();
        $clientRepository->createPersonalAccessClient(
            null,
            self::TEST_PERSONAL_ACCESS_CLIENT,
            'http://localhost'
        );
    }
}
