<?php

namespace Tests\Feature\Api\PowersyncData\Access;

use App\Constants\HttpStatus as STATUS;
use Database\Seeders\StudentSeeder;
use Tests\Feature\Api\PowersyncData\PowersyncUploadApiTestCase;

class AuthenticatedPowersyncUploadTest extends PowersyncUploadApiTestCase
{
    public function setup(): void
    {
        parent::setUp();
        $this->loginAsUser(StudentSeeder::STUDENT_EXAMPLE_MAIL);
    }

    public function test_can_upload_valid_assessment_data(): void
    {
        $res = $this->upload_valid_assessment_data();
        $this->assertSuccess($res);
    }

    public function test_cannot_upload_data_with_invalid_table_name(): void
    {
        $res = $this->upload_data_with_invalid_table_name();
        $this->assertFail($res, STATUS::HTTP_BAD_REQUEST);
    }

    public function test_cannot_upload_incomplete_assessment_data(): void
    {
        $res = $this->upload_incomplete_assessment_data();
        $this->assertFail($res, STATUS::HTTP_INTERNAL_SERVER_ERROR);
    }
}
