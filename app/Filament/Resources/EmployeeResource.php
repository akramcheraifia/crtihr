<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Corp;
use App\Models\Employee;
use App\Models\Filiere;
use App\Models\Grade;
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
use PhpParser\Node\Stmt\Label;

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
       ->label('Filiere')
       ->options(Filiere::all()->pluck('nom','id')->toArray())
       ->reactive()
       ->afterStateUpdated(fn (callable $set) => $set('corp_id',null)),
    Select::make('corp_id')
        ->label('Corp')
        ->options(function (callable $get){
            $filiere = Filiere::find($get('filiere_id'));
            if (!$filiere) {
                return Corp::all()->pluck('nom','id');
            }
            return $filiere->corp->pluck('nom','id');
        })
        ->reactive()
       ->afterStateUpdated(fn (callable $set) => $set('grade_id',null)),

       Select::make('grade_id')
        ->label('Grade')
        ->options(function (callable $get){
            $corp = Corp::find($get('corp_id'));
            if (!$corp) {
                return Grade::all()->pluck('nom','id');
            }
            return $corp->grade->pluck('nom','id');
        })
        ->reactive(),

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
