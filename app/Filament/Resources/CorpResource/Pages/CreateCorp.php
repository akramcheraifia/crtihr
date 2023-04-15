<?php

namespace App\Filament\Resources\CorpResource\Pages;

use App\Filament\Resources\CorpResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCorp extends CreateRecord
{
    protected static string $resource = CorpResource::class;
    protected static ?string $title = 'Créer un corp';
}
