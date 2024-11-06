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
            'email' => $this->email,
            'first_name' => $this->userProfile->first_name,
            'last_name' => $this->userProfile->last_name,
            'role' => $this->getRoleNames()->first(),
            'school_name' => $this->getCurrentAcademicYear()->school->short_name,
            'academic_year' => $this->getCurrentAcademicYear()->name,
        ];
    }
}
