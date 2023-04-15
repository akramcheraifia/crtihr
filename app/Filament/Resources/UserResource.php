<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Label;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Paramètres';
    protected static ?string $navigationLabel = 'Utilisateurs';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->autofocus()
                            ->label('Nom')
                            ->placeholder('Entrez un nom...'),
                        TextInput::make('email')
                            ->required()
                            ->placeholder('Enter un email...')
                            ->maxLength(255)
                            ->email(),
                        TextInput::make('password')
                            ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                            ->placeholder('Entrer un mot de passe...')
                            ->label('Mot de passe')
                            ->minLength(8)
                            ->password()
                            ->same('passwordConfirmation')
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(fn ($state)=> Hash::make($state)),
                            TextInput::make('passwordConfirmation')
                            ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                            ->placeholder('Confirmez le mot de passe...')
                            ->label('Confirmation du mot de passe')
                            ->minLength(8)
                            ->same('password')
                            ->dehydrated(false)
                            ->password(),
                            Select::make('roles')
                            ->multiple()
                            ->relationship('roles', 'name')->preload()
                            ->label('Rôle')
                                        ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable()->sortable()->label('Nom'),
                TextColumn::make('email')->searchable()->sortable()->label('Email'),
                TextColumn::make('roles.name')->sortable()->label('Rôle'),
                TextColumn::make('created_at')->dateTime()->sortable()->label('Créé le'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
