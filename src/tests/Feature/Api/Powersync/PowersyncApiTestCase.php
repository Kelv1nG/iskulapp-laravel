<?php

namespace Tests\Feature\Api\Powersync;

use Illuminate\Testing\TestResponse;
use Tests\Feature\ApiBaseTest;

class PowersyncApiTestCase extends ApiBaseTest
{
    const PUBLIC_KEYS_URI = 'api/get_keys';

    const PS_TOKEN_URI = 'api/get_powersync_token';

    const GET_KEYS_RESPONSE_STRUCTURE = [
        'keys' => [
            '*' => [
                'kty',
                'n',
                'e',
                'alg',
                'kid',
            ],
        ],
    ];

    const GET_PS_TOKEN_STRUCTURE = [
        'token',
        'powersync_url',
    ];

    public function getPublicKey(): TestResponse
    {
        return $this->get(self::PUBLIC_KEYS_URI);
    }

    public function getPowersyncToken(): TestResponse
    {
        return $this->get(self::PS_TOKEN_URI);
    }
}
