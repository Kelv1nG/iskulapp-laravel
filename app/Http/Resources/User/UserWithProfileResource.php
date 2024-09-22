<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserWithProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->userProfile->first_name,
            'last_name' => $this->userProfile->last_name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'birth_date' => optional($this->userProfile)->birth_date,
            'gender' => optional($this->userProfile)->gender,
        ];
    }
}
