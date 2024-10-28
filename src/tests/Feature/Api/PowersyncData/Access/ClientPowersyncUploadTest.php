<?php

namespace Tests\Feature\Api\PowersyncData\Access;

use App\Constants\HttpStatus as STATUS;
use Tests\Feature\Api\PowersyncData\PowersyncUploadApiTestCase;

class ClientPowersyncUploadTest extends PowersyncUploadApiTestCase
{
    public function setup(): void
    {
        parent::setUp();
        $this->loginAsClient();
    }

    public function test_cannot_upload_valid_assessment_data(): void
    {
        $res = $this->upload_valid_assessment_data();
        $this->assertFail($res, STATUS::HTTP_UNAUTHORIZED);
    }
}
