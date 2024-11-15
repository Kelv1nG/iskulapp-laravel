<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ImportField;
use App\Filament\Exports\TeacherExporter;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    Group::make([
                        TextInput::make('first_name'),
                        TextInput::make('last_name'),
                        DatePicker::make('birth_date')
                            ->native(false)
                            ->displayFormat('Y/d/m'),
                    ])
                    ->relationship('userProfile'),
                    TextInput::make('email'),
                ])
                ->relationship('user'),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make(), // Add export action
            ImportAction::make()
                ->uniqueField('name')
                ->fields([
                    ImportField::make('name')->required(),
                    ImportField::make('category.name')->required()->label('Category name'),
                    ImportField::make('stock')->required(),
                ]),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Name')->state(function (Teacher $userProfile) {
                    return $userProfile->user->userProfile->first_name . ' ' . $userProfile->user->userProfile->last_name;
                }),
                TextColumn::make('user.email')->label('Email'),
                TextColumn::make('Birthday')->state(function (Teacher $userProfile) {
                    return $userProfile->user->userProfile->birth_date;
                }),
                TextColumn::make('Gender')->state(function (Teacher $userProfile) {
                    return $userProfile->user->userProfile->gender;
                }),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(TeacherExporter::class)
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
