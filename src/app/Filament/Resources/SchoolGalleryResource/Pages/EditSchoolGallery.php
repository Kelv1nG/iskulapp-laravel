<?php

namespace App\Filament\Resources\SchoolGalleryResource\Pages;

use App\Filament\Resources\SchoolGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolGallery extends EditRecord
{
    protected static string $resource = SchoolGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
