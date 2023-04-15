<?php

namespace App\Filament\Resources\FiliereResource\Pages;

use App\Filament\Resources\FiliereResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFilieres extends ListRecords
{
    protected static string $resource = FiliereResource::class;
    protected static ?string $title = 'Filières';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
