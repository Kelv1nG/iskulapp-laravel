<?php

namespace Tests\Feature\Api\Powersync\Access;

use App\Constants\HttpStatus as STATUS;
use Database\Seeders\StudentSeeder;
use Tests\Feature\Api\Powersync\PowersyncApiTestCase;

class AuthenticatedPowersyncApiTest extends PowersyncApiTestCase
{
    public function setup(): void
    {
        parent::setUp();
        $this->loginAsUser(StudentSeeder::STUDENT_EXAMPLE_MAIL);
    }

    public function test_can_get_public_key(): void
    {
        $res = $this->getPublicKey();
        $this->assertSuccess($res, STATUS::HTTP_OK, self::GET_KEYS_RESPONSE_STRUCTURE);
    }

    public function test_can_get_ps_token(): void
    {
        $res = $this->getPowersyncToken();
        $this->assertSuccess($res, STATUS::HTTP_OK, self::GET_PS_TOKEN_STRUCTURE);
    }
}
