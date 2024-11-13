<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Select;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;
    protected static ?string $navigationIcon = 'heroicon-o-check';

    // Removed the incorrect 'use App\Models\AcademicYear;'

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('student_id')
                ->label('Student')
                ->options(User::query()
                    ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id') 
                    ->join('students', 'users.id', '=', 'students.user_id') 
                    ->selectRaw("CONCAT(user_profiles.first_name, ' ', user_profiles.last_name) as full_name, students.student_no")
                    ->pluck('full_name', 'students.student_no')
                    ->toArray())
                ->required()
                ->searchable(),
    
            Forms\Components\Hidden::make('user_id')
                ->default(auth()->user()->id), // Set user_id by default
    
            Select::make('academic_year_id') // Assuming the foreign key column is academic_year_id
                ->label('Academic Year')
                ->options(AcademicYear::pluck('name', 'id')->toArray()) // Pull the name and id from AcademicYear model
                ->required()
                ->searchable(),
    
            DatePicker::make('attendance_date')
                ->label('Date')
                ->required(),
    
            TimePicker::make('time_in')
                ->label('Time In')
                ->required(),
    
            TimePicker::make('time_out')
                ->label('Time Out')
                ->nullable(),
        ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_id')->label('Student'),
                TextColumn::make('academic_year_id')
                    ->label('Academic Year ID'),
                
                TextColumn::make('attendance_date')
                    ->label('Date')
                    ->date(),
                TextColumn::make('time_in')->label('Time In')->time(),
                TextColumn::make('time_out')->label('Time Out')->time(),
                TextColumn::make('created_at')->label('Created At')->date(),
                TextColumn::make('updated_at')->label('Updated At')->date(),
            ])
            ->filters([/* Your filters */])
            ->actions([  
                EditAction::make(),  
            ])
            ->bulkActions([  
                BulkActionGroup::make([  
                    DeleteBulkAction::make(),  
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add any relations here if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}
