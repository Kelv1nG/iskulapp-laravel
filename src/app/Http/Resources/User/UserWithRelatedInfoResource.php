<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserWithRelatedInfoResource extends JsonResource
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
            'login_type' => $this->getRoleNames()->first(),
            'login_id' => $this->getLoginId(),
            'first_name' => $this->userProfile->first_name,
            'last_name' => $this->userProfile->last_name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'birth_date' => optional($this->userProfile)->birth_date,
            'gender' => optional($this->userProfile)->gender,
            'role' => $this->getRoleNames()->first(),
        ];
    }

    /**
     * Get the login ID based on user type (teacher or student).
     */
    protected function getLoginId(): ?string
    {
        return match ($this->getRoleNames()->first()) {
            'teacher' => $this->teacher?->id,
            'student' => $this->student?->id,
            default => null
        };
    }
}
