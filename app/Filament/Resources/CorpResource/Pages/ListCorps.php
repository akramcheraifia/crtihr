<?php

namespace App\Filament\Resources\CorpResource\Pages;

use App\Filament\Resources\CorpResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCorps extends ListRecords
{
    protected static string $resource = CorpResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
