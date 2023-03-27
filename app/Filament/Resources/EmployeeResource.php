<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Corp;
use App\Models\Employee;
use App\Models\Filiere;
use App\Models\Grade;
use App\Models\Site;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
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
       ->required()
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
        ->required()
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
        ->reactive()
        ->required(),
    Select::make('site_id')
        ->relationship('site', 'nom')->required(),
    TextInput::make('prenom')->required()->maxLength(255),
    TextInput::make('nom')->required()->maxLength(255),
    TextInput::make('prenom_ar')->required()->maxLength(255)->label('Prenom Arabe'),
    TextInput::make('nom_ar')->required()->maxLength(255)->label('Nom Arabe'),
    TextInput::make('NIN')->required()->maxLength(20)->label('NIN'),
    TextInput::make('CNAS')->maxLength(20)->label('CNAS'),
    DatePicker::make('date_naissance')->required()->label('Date de naissance'),
    DatePicker::make('date_recrutement')->required()->label('Date de recrutement'),
    TextInput::make('lieu_naissance')->required()->maxLength(255)->label('Lieu de naissance'),
    Select::make('sexe')
    ->options([
        'MALE' => 'Male',
        'FEMALE' => 'Female',
    ])->required(),
    Select::make('situation_familiale')
    ->options([
        'MARIEE' => 'Mariée',
        'CELIBATAIRE' => 'Célibataire',
        'VEUF' => 'Veuf',
        'DIVORCEE' => 'Divorcée',
    ])->required(),
    Select::make('type_contrat')
    ->options([
        'Permanant' => 'Permanant',
        'Contractuel' => 'Contractuel',
    ])->required(),
    Select::make('status')
    ->options([
        'active' => 'Active',
        'Inactive' => 'Inactive',
        'mis en disponibilité' => 'Mis en disponibilité',
        'détacher' => 'Détacher',
    ])->required(),
    TextInput::make('RIB')->required()->maxLength(20)->label('RIB'),
    TextInput::make('email')->required()->email(),
    TextInput::make('phone')->required()->tel()->label('Numéro téléphone'),
    SpatieMediaLibraryFileUpload::make('Photo')->collection('photos'),


])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                SpatieMediaLibraryImageColumn::make('Photo')->collection('photos'),
                TextColumn::make('nom')->searchable()->sortable(),
                TextColumn::make('prenom')->searchable()->sortable(),
                TextColumn::make('site.nom')->sortable()->searchable(),
                TextColumn::make('filiere.nom')->sortable()->searchable(),
                TextColumn::make('corp.nom')->sortable()->searchable(),
                TextColumn::make('grade.nom')->sortable()->searchable(),
                TextColumn::make('status')->sortable()->searchable(),
                TextColumn::make('date_recrutement')->dateTime(),
                TextColumn::make('created_at')->dateTime(),

            ])
            ->filters([
                SelectFilter::make('filiere')->relationship('filiere', 'nom'),
                SelectFilter::make('corp')->relationship('corp', 'nom'),
                SelectFilter::make('grade')->relationship('grade', 'nom'),
                SelectFilter::make('site')->relationship('site', 'nom'),
                SelectFilter::make('status')
                ->options([
                    'active' => 'Active',
                    'Inactive' => 'Inactive',
                    'mis en disponibilité' => 'Mis en disponibilité',
                    'détacher' => 'Détacher',
                ])

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([

                FilamentExportHeaderAction::make('export')
                ->disableAdditionalColumns()
                ->fileNameFieldLabel('Nom de fichier')
                ->filterColumnsFieldLabel('Filtrer les colonnes')

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

protected function getTableHeaderActions(): array
{
    return [

        FilamentExportHeaderAction::make('Export'),
    ];
}
}
