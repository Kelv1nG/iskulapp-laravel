<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolGalleryResource\Pages;
use App\Filament\Resources\SchoolGalleryResource\RelationManagers;
use App\Models\SchoolGallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolGalleryResource extends Resource
{
    protected static ?string $model = SchoolGallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Image Description')
                            ->rows(4)
                            ->maxLength(1000),

                        Forms\Components\FileUpload::make('image_path')
                            ->label('Upload Image')
                            ->image()
                            ->directory('school-gallery') // Store images in "storage/app/public/school-gallery"
                            ->required()
                            ->maxSize(2048) // Limit to 2MB
                            ->imagePreviewHeight('200px'),
                    ])
                    ->columns(1),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50), // Limit display length
            ])
            ->filters([
              
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchoolGalleries::route('/'),
            'create' => Pages\CreateSchoolGallery::route('/create'),
            'edit' => Pages\EditSchoolGallery::route('/{record}/edit'),
        ];
    }
}
