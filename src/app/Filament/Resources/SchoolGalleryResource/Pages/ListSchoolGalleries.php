<?php

namespace App\Filament\Resources\SchoolGalleryResource\Pages;

use App\Filament\Resources\SchoolGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolGalleries extends ListRecords
{
    protected static string $resource = SchoolGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
