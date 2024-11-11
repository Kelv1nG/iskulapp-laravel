<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuardianResource\Pages;
use App\Models\Guardian;
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
use Filament\Forms\Components\Select;
use App\Enums\RoleEnum;

class GuardianResource extends Resource
{
    protected static ?string $model = Guardian::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('first_name')
                ->label('First Name')
                ->required(),
            
            TextInput::make('last_name')
                ->label('Last Name')
                ->required(),
            
            TextInput::make('user_email')
                ->label('User Email')
                ->required()
                ->email(),
            
            TextInput::make('user_password')
                ->label('Password')
                ->required()
                ->password()
                ->minLength(8),
    
            // Add a birth date field
            DatePicker::make('birth_date')
                ->label('Birth Date')
                ->required(),
    
            // Add gender selection
            Select::make('gender')
                ->label('Gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other',
                ])
                ->required(),
        ]);
    }
    
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Display full name as "Last Name, First Name"
                TextColumn::make('Guardian Name')->state(function (Guardian $guardian) {
                    return $guardian->user->userProfile->first_name . ' ' . $guardian->user->userProfile->last_name ;
                }),
                TextColumn::make('user.email')->label('Email'),
                TextColumn::make('user.userProfile.gender')->label('Created At'),
                TextColumn::make('created_at')->label('Created At')->date(),
                TextColumn::make('updated_at')->label('Updated At')->date(),
            ])
            ->filters([/* Your filters */])
            ->actions([  
                EditAction::make(),  // Directly adding the EditAction here
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
            // Add any relations here if needed, such as a UserProfile relation
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuardians::route('/'),
            'create' => Pages\CreateGuardian::route('/create'),
            'edit' => Pages\EditGuardian::route('/{record}/edit'),
        ];
    }

    public static function createGuardianWithUser(array $data)
    {
        // Check if the email already exists
        $existingUser = User::where('email', $data['user_email'])->first();
        if ($existingUser) {
            // Handle the case where the email already exists
            throw new \Exception('Email already exists');
        }
    
        // Create the user with first and last name
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['user_email'],
            'password' => bcrypt($data['user_password']),
        ]);
    
        // Assuming there's a UserProfile model that needs to be associated
        $user->userProfile()->create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],  // Pass the first name here
            'last_name' => $data['last_name'],    // Pass the last name here
            'birth_date' => $data['birth_date'],  // Pass the birth_date here
            'gender' => $data['gender'],          // Pass the gender here
        ]);
    
        // Create the Guardian with the resolved user_id
        $guardian = Guardian::create([
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return $guardian;
    }
    
}

