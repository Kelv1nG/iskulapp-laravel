<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use App\Models\User;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Event Title'),
                Textarea::make('summary')
                    ->label('Event Summary')
                    ->maxLength(500)
                    ->rows(3),
                RichEditor::make('description')
                    ->label('Event Description'),
                Select::make('school_id')
                    ->relationship('school', 'name')
                    ->required()
                    ->label('School'),
                    Select::make('posted_by')
                    ->options(User::query()
                        ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
                        ->selectRaw("CONCAT(user_profiles.first_name, ' ', user_profiles.last_name) as full_name, users.id")
                        ->pluck('full_name', 'users.id')
                        ->toArray())
                    ->required()
                    ->label('Posted By'),
                
                
                DateTimePicker::make('event_schedule')
                    ->required()
                    ->label('Event Schedule'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->label('Event Title'),
                TextColumn::make('summary')
                    ->limit(50)
                    ->label('Summary'),
                TextColumn::make('school.name')
                    ->sortable()
                    ->label('School'),
                    TextColumn::make('Posted by')->state(function (Event $user) {
                        return $user->postedBy->userProfile->first_name . ' ' . $user->postedBy->userProfile->last_name;
                    }),
                TextColumn::make('event_schedule')
                    ->sortable()
                    ->dateTime()
                    ->label('Schedule'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created At'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Updated At'),
            ])
            ->filters([
                Tables\Filters\Filter::make('school_id')
                    ->label('Filter by School')
                    ->form([
                        Forms\Components\Select::make('school_id')
                            ->relationship('school', 'name')
                            ->label('School'),
                    ]),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
