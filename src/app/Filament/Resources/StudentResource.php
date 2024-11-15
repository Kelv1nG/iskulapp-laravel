<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\School;
use App\Models\AcademicYear;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    Group::make([
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->required(),
                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->required(),
                    ])
                    ->relationship('userProfile'), // Ensure 'userProfile' is correct here
                    TextInput::make('email')
                        ->label('Email')
                        ->required(),
                    Select::make('school_id')
                        ->label('School')
                        ->options(School::all()->pluck('name', 'id'))
                        ->required()
                        ->searchable()
                        ->placeholder('Select School'),
                    Select::make('academic_year_id')
                        ->label('Academic Year')
                        ->options(AcademicYear::all()->pluck('name', 'id'))
                        ->required()
                        ->searchable()
                        ->placeholder('Select Academic Year'),
                ])
                ->relationship('user'), // Assuming 'user' is a relationship on the Student model
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Name')->state(function (Student $student) {
                    return $student->user->userProfile->first_name . ' ' . $student->user->userProfile->last_name;
                }),
                TextColumn::make('Email')->state(function (Student $student) {
                    return $student->user->email;
                }),
                TextColumn::make('School')->state(function (Student $student) {
                    return $student->academicYears->first()?->school->name ?? 'N/A';
                }),
                TextColumn::make('Academic Year')->state(function (Student $student) {
                    return $student->academicYears->first()?->name ?? 'N/A';
                }),
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
            // Add any additional relationships here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
