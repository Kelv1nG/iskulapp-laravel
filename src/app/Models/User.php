<?php

namespace App\Models;

use App\Enums\RoleEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function getLoginId(): ?int
    {
        $role = $this->getRoleNames()->first();

        return match ($role) {
            RoleEnum::TEACHER->value => $this->teacher?->id,
            RoleEnum::STUDENT->value => $this->student?->id,
            default => null
        };
    }

    public function getCurrentAcademicYear(): ?AcademicYear
    {
        $role = $this->getRoleNames()->first();

        return match ($role) {
            RoleEnum::TEACHER->value => $this->teacher?->academicYears()
                ->latest('end')
                ->first(),
            RoleEnum::STUDENT->value => $this->student?->academicYears()
                ->latest('end')
                ->first(),
            default => null
        };
    }

    public function getCurrentSchool(): ?School
    {
        $academicYear = $this->getCurrentAcademicYear();

        return $academicYear?->school;
    }

    public function getFilamentName(): string
    {
        return 'Admin';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(RoleEnum::ADMIN);
    }
}
