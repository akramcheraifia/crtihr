<?php

namespace App\Filament\Resources\SiteResource\Pages;

use App\Filament\Resources\SiteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSites extends ListRecords
{
    protected static string $resource = SiteResource::class;
    protected static ?string $title = 'Sites';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
