<?php

namespace Tests\Feature;

use App\Constants\HttpStatus as STATUS;
use App\Models\User;
use Database\Seeders\OauthClientSeeder;
use Illuminate\Testing\TestResponse;
use Laravel\Passport\Client;
use Tests\TestCase;

class ApiBaseTest extends TestCase
{
    public function setup(): void
    {
        parent::setup();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    protected string $accessToken;

    /**
     * Check response success
     */
    protected function assertSuccess(TestResponse $testResponse, $status = STATUS::HTTP_OK, $json = []): void
    {
        $testResponse->assertStatus($status);
        if ($json) {
            $testResponse->assertJsonStructure($json);
        }
    }

    /**
     * Check response error message
     */
    protected function assertFail(TestResponse $testResponse, $status, $errorBag = []): void
    {
        $testResponse->assertStatus($status);
        if ($errorBag) {
            $testResponse->assertJson($errorBag);
        }
    }

    /**
     * Check unauthenticated
     */
    protected function assertUnauthenticated(TestResponse $testResponse): void
    {
        $testResponse->assertStatus(STATUS::HTTP_UNAUTHORIZED);
    }

    /**
     * Sign in as user with the specified email.
     *
     * Method generates a user token and attaches it to the request headers
     * for authentication purposes.
     *
     * @param  string  $email  The email of the user to sign in as.
     */
    public function loginAsUser(string $email): void
    {
        $token = $this->generateUserToken($email);
        $this->attachTokenToHeader($token);
    }

    public function loginAsClient(): void
    {
        $token = $this->generateClientToken();
        $this->attachTokenToHeader($token);
    }

    public function generateUserToken(string $email): string
    {
        $user = User::where('email', $email)->first();

        return $user->createToken('TestToken')->accessToken;
    }

    public function generateClientToken(): string
    {
        $client = Client::where('name', OauthClientSeeder::TEST_CLIENT)->first();
        $response = $this->post('/oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
        ]);

        return $response->json()['access_token'];
    }

    public function attachTokenToHeader($token): void
    {
        $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ]);
    }
}
