<?php

namespace App\Filament\Resources\CorpResource\Pages;

use App\Filament\Resources\CorpResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCorp extends EditRecord
{
    protected static string $resource = CorpResource::class;
    protected static ?string $title = 'Modifier un corp';

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
