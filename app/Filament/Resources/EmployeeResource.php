<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
->schema([
    Select::make('filiere_id')
->relationship('filiere', 'nom')->required(),
Select::make('corp_id')
->relationship('corp', 'nom')->required(),
Select::make('grade_id')
->relationship('grade', 'nom')->required(),
    TextInput::make('prenom')->required(),
    TextInput::make('nom')->required(),
    TextInput::make('prenom_ar')->required(),
    TextInput::make('nom_ar')->required(),
    TextInput::make('NIN')->required(),
    TextInput::make('CNAS'),
    DatePicker::make('date_naissance')->required(),
    DatePicker::make('date_recrutement')->required(),
    TextInput::make('lieu_naissance')->required(),
    Select::make('sexe')
    ->options([
        'MALE' => 'Male',
        'FEMALE' => 'Female',
    ])->required(),
    Select::make('situation_familiale')
    ->options([
        'MARIEE' => 'M',
        'CELIBATAIRE' => 'C',
        'VEUF' => 'V',
        'DIVORCEE' => 'D',
    ])->required(),
    Select::make('type_contrat')
    ->options([
        'PERMANANTE' => 'PERMANANTE',
        'CONTRACTUELLE' => 'CONTRACTUELLE',
        'STAGE' => 'STAGE',
    ])->required(),
    TextInput::make('CCP')->required(),
    TextInput::make('email')->required(),
    TextInput::make('phone')->required(),

])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('nom')->searchable()->sortable(),
                TextColumn::make('prenom')->searchable()->sortable(),
                TextColumn::make('filiere.nom')->sortable()->searchable(),
                TextColumn::make('corp.nom')->sortable()->searchable(),
                TextColumn::make('grade.nom')->sortable()->searchable(),
                TextColumn::make('date_recrutement')->dateTime(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('filiere')->relationship('filiere', 'nom'),
                SelectFilter::make('corp')->relationship('corp', 'nom'),
                SelectFilter::make('grade')->relationship('grade', 'nom')

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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
