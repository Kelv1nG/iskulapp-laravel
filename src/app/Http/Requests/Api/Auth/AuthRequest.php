<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthRequest extends FormRequest
{
    /**
     * only clients can perform this action
     */
    public function authorize(): bool
    {
        return Auth::guard('api')->user() == null;
    }
}
