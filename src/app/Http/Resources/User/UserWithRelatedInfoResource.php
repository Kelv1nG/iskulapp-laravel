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
        /// int ids are converted to string for consistency with string uuids in mobile
        return [
            'id' => strval($this->id),
            'login_type' => $this->getRoleNames()?->first(),
            'login_id' => strval($this->getLoginId()),
            'role' => $this->getRoleNames()?->first(),
            'email' => $this->email,
            'first_name' => $this->userProfile->first_name,
            'last_name' => $this->userProfile->last_name,
            'school_id' => strval($this->getCurrentAcademicYear()?->school->id),
            'school_name' => $this->getCurrentAcademicYear()?->school->short_name,
            'academic_year_id' => strval($this->getCurrentAcademicYear()?->id),
            'academic_year_name' => $this->getCurrentAcademicYear()?->name,
        ];
    }
}
