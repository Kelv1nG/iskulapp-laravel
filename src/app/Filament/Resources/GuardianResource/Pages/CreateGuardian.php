<?php

namespace App\Filament\Resources\GuardianResource\Pages;

use App\Filament\Resources\GuardianResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGuardian extends CreateRecord
{
    protected static string $resource = GuardianResource::class;

    // Your overridden method to handle record creation
    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Your guardian creation logic
        $guardian = GuardianResource::createGuardianWithUser($data);
        return $guardian;
    }
}

