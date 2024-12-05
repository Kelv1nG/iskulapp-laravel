<?php

namespace App\Utils;

use App\Enums\RoleEnum;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
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

    public static function createJwtToken(User $user)
    {
        self::ensureKeys();
        $privateKeyJson = json_decode(base64_decode(self::$powerSyncPrivateKey), true);

        if (! $privateKeyJson) {
            throw new Exception('Invalid private key format.');
        }

        $jwk = new JWK($privateKeyJson);

        $teacher = self::getTeacher($user);
        $teacherCurrentSubjects = $teacher ? array_values($teacher->currentSubjectYears()->pluck('id')->toArray()) : [];

        $student = self::getStudent($user);
        $studentCurrentSubjects = $student ? array_values($student->currentSubjectYears()->pluck('id')->toArray()) : [];
        $studentCurrentSections = $student ? array_values($student->currentSections()->pluck('id')->toArray()) : [];

        $payload = json_encode([
            'sub' => $user->id,
            'iat' => time(),
            'aud' => self::$powerSyncUrl,
            'exp' => time() + 300, // unit is in seconds

            'current_school_id' => $user->getCurrentSchool()->id,
            'current_academic_year_id' => $user->getCurrentAcademicYear()->id,

            'teacher_id' => $teacher?->id,
            'teacher_current_subject_years' => $teacherCurrentSubjects,

            'student_id' => $student?->id,
            'student_current_subject_years' => $studentCurrentSubjects,
            'student_current_sections' => $studentCurrentSections,
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

    private static function getTeacher($user): ?Teacher
    {
        $teacherId = self::getLoginSpecificId($user, RoleEnum::TEACHER->value);

        return Teacher::find($teacherId);
    }

    private static function getStudent($user): ?Student
    {
        $studentId = self::getLoginSpecificId($user, RoleEnum::STUDENT->value);

        return Student::find($studentId);
    }

    private static function getLoginSpecificId($user, string $role): ?int
    {
        return $user->getRoleNames()->first() === $role
            ? $user->getLoginId()
            : null;
    }
}
