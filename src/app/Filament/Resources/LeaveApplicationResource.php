<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Enums\LeaveType;
use Filament\Forms\Form;
use App\Enums\LeaveStatus;
use Filament\Tables\Table;
use App\Models\LeaveApplication;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\LeaveApplicationResource\Pages;

class LeaveApplicationResource extends Resource
{
    protected static ?string $model = LeaveApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Leave Application Details')
                    ->schema([
                        TextInput::make('employee_name')
                            ->label('Employee Name')
                            ->required()
                            ->maxLength(255),

                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->required(),

                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->required(),

                        Select::make('leave_type')
                            ->label('Leave Type')
                            ->options(
                                collect(LeaveType::cases())
                                    ->mapWithKeys(fn($case) => [$case->value => str_replace('_', ' ', $case->name)])
                                    ->toArray()
                            )
                            ->required(),

                        Textarea::make('reason')
                            ->label('Reason')
                            ->maxLength(500),

                        Select::make('status')
                            ->label('Status')
                            ->options(
                                collect(LeaveStatus::cases())
                                    ->mapWithKeys(fn($case) => [$case->value => ucfirst(strtolower($case->name))])
                                    ->toArray()
                            )
                            ->required()
                            ->default(LeaveStatus::PENDING->value),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee_name')
                    ->label('Employee Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('End Date')
                    ->sortable(),

                TextColumn::make('leave_type')
                    ->label('Leave Type')
                    ->formatStateUsing(fn($state) => str_replace('_', ' ', $state)),

                TextColumn::make('leave_status')
                    ->label('Status')
                    ->sortable()
                    ->badge(fn($state) => match ($state) {
                        LeaveStatus::PENDING->value => 'warning',
                        LeaveStatus::APPROVED->value => 'success',
                        LeaveStatus::REJECTED->value => 'danger',
                        default => 'secondary',
                    }),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeaveApplications::route('/'),
            'create' => Pages\CreateLeaveApplication::route('/create'),
            'edit' => Pages\EditLeaveApplication::route('/{record}/edit'),
        ];
    }
}
