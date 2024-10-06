<?php

namespace App\Constants\ApiMessages;

class AuthMessage implements ApiMessage
{
    public const REGISTRATION_SUCCESS = 'Registration success';

    public const AUTHENTICATION_SUCCESS = 'Authentication success';

    public const LOGOUT_SUCCESS = 'Successfully logged out';

    public const INVALID_CREDENTIALS = 'Invalid credentials';

    public const NO_USER_ASSOCIATED = 'No user associated with the provided token';
}
