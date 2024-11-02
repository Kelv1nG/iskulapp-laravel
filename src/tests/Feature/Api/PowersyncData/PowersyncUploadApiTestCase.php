<?php

namespace Tests\Feature\Api\PowersyncData;

use Illuminate\Testing\TestResponse;
use Tests\Feature\ApiBaseTest;

class PowersyncUploadApiTestCase extends ApiBaseTest
{
    protected const UPLOAD_DATA_ENDPOINT = '/api/upload_data';

    const VALID_ASSESSMENT_DATA = [
        'table' => 'assessments',
        'data' => [
            'id' => 'b473c34d-192b-44bf-9f85-4773cb73c719',
            'prepared_by' => 1,
            'assessment_type' => 'assignment',
            'title' => 'Test Mic 123',
            'total_questions' => 20,
            'start_time' => '2024-10-28T02:09:13.755735',
            'dead_line' => '2024-10-28T02:09:13.756736',
            'status' => 'to_be_completed',
            'created_at' => '2024-10-27 18:09:15',
            'updated_at' => '2024-10-27 18:09:15',
        ],
    ];

    const INVALID_TABLE_DATA = [
        'table' => 'invalid_table',
        'data' => [
            'id' => 'b473c34d-192b-44bf-9f85-4773cb73c719',
            'field' => 'value',
        ],
    ];

    const INCOMPLETE_DATA = [
        'table' => 'assessments',
        'data' => [
            'id' => 'b473c34d-192b-44bf-9f85-4773cb73c719',
            'title' => 'Incomplete Assessment',
            // Missing required fields
        ],
    ];

    public function upload_valid_assessment_data(): TestResponse
    {
        $response = $this->putJson(
            self::UPLOAD_DATA_ENDPOINT,
            self::VALID_ASSESSMENT_DATA
        );

        return $response;
    }

    public function upload_data_with_invalid_table_name(): TestResponse
    {
        $response = $this->putJson(
            self::UPLOAD_DATA_ENDPOINT,
            self::INVALID_TABLE_DATA
        );

        return $response;
    }

    public function upload_incomplete_assessment_data(): TestResponse
    {
        $response = $this->putJson(
            self::UPLOAD_DATA_ENDPOINT,
            self::INCOMPLETE_DATA,
        );

        return $response;
    }
}
