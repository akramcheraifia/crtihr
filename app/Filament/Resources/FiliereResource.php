<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FiliereResource\Pages;
use App\Filament\Resources\FiliereResource\RelationManagers;
use App\Models\Filiere;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FiliereResource extends Resource
{
    protected static ?string $model = Filiere::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';
    protected static ?string $navigationGroup = 'Structure';
    protected static ?string $navigationLabel = 'Filière';
    protected static ?int $navigationSort =1;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
    ->schema([
        TextInput::make('nom')
        ->required(255)
    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')->searchable()->sortable(),
                TextColumn::make('created_at')->dateTime()->label('Créé le'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->modalHeading('Modifier la filière'),
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
            'index' => Pages\ListFilieres::route('/'),
            'create' => Pages\CreateFiliere::route('/create'),
        ];
    }
}
