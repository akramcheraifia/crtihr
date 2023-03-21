<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CorpResource\Pages;
use App\Filament\Resources\CorpResource\RelationManagers;
use App\Models\Corp;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CorpResource extends Resource
{
    protected static ?string $model = Corp::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Structure';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
    ->schema([
        Select::make('filiere_id')
    ->relationship('filiere', 'nom')->required(),
        TextInput::make('nom')->required()
    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('nom')->searchable()->sortable()->searchable(),
                TextColumn::make('filiere.nom')->sortable(),
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCorps::route('/'),
            'create' => Pages\CreateCorp::route('/create'),
            'edit' => Pages\EditCorp::route('/{record}/edit'),
        ];
    }
}
