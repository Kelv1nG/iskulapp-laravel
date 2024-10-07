<?php

namespace Tests\Feature\Api\Powersync\Access;

use App\Constants\HttpStatus as STATUS;
use Tests\Feature\Api\Powersync\PowersyncApiTestCase;

class ClientPowersyncApiTest extends PowersyncApiTestCase
{
    public function setup(): void
    {
        parent::setUp();
        $this->loginAsClient();
    }

    public function test_can_get_public_key(): void
    {
        $res = $this->getPublicKey();
        $this->assertSuccess($res, STATUS::HTTP_OK, self::GET_KEYS_RESPONSE_STRUCTURE);
    }

    public function test_cannot_get_ps_token(): void
    {
        $res = $this->getPowersyncToken();
        $this->assertUnauthenticated($res);
    }
}
