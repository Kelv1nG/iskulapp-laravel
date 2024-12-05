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
    
            
            DatePicker::make('birth_date')
                ->label('Birth Date')
                ->required(),
    
            
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
        
        $existingUser = User::where('email', $data['user_email'])->first();
        if ($existingUser) {
            
            throw new \Exception('Email already exists');
        }
    
        
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['user_email'],
            'password' => bcrypt($data['user_password']),
        ]);
    
        
        $user->userProfile()->create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'birth_date' => $data['birth_date'],
            'gender' => $data['gender'],
        ]);
    
        
        $guardian = Guardian::create([
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return $guardian;
    }
    
}

