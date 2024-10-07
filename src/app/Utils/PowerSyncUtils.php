<?php

namespace App\Utils;

use Exception;
use Illuminate\Support\Facades\Config;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\JWK;
use Jose\Component\Signature\Algorithm\RS256;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Signature\Serializer\CompactSerializer;

class PowerSyncUtils
{
    private static $powerSyncPrivateKey;

    private static $powerSyncPublicKey;

    public static $powerSyncUrl;

    private static function ensureKeys()
    {
        self::$powerSyncPrivateKey = Config::get('powersync.private_key');
        self::$powerSyncPublicKey = Config::get('powersync.public_key');
        self::$powerSyncUrl = Config::get('powersync.url');
        if (empty(self::$powerSyncPrivateKey) || empty(self::$powerSyncPublicKey)) {
            throw new Exception('PowerSync keys are not configured.');
        }
    }

    public static function createJwtToken($userId)
    {
        self::ensureKeys();
        $privateKeyJson = json_decode(base64_decode(self::$powerSyncPrivateKey), true);

        if (! $privateKeyJson) {
            throw new Exception('Invalid private key format.');
        }

        $jwk = new JWK($privateKeyJson);

        $payload = json_encode([
            'sub' => $userId,
            'iat' => time(),
            'aud' => self::$powerSyncUrl,
            'exp' => time() + 300, // unit is in seconds
        ]);

        // Create AlgorithmManager with RS256
        $algorithmManager = new AlgorithmManager([
            new RS256(),
        ]);

        $jwsBuilder = new JWSBuilder($algorithmManager);
        $jws = $jwsBuilder
            ->create()
            ->withPayload($payload)
            ->addSignature($jwk, [
                'alg' => $privateKeyJson['alg'],
                'kid' => $privateKeyJson['kid'],
                'typ' => 'JWT',
            ])
            ->build();

        $serializer = new CompactSerializer();
        $token = $serializer->serialize($jws);

        return $token;
    }

    public static function getPublicKeyJson()
    {
        self::ensureKeys();
        $publicKeyJson = json_decode(base64_decode(self::$powerSyncPublicKey), true);

        return $publicKeyJson;
    }
}
