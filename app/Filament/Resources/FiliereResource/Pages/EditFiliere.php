<?php

namespace App\Filament\Resources\FiliereResource\Pages;

use App\Filament\Resources\FiliereResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFiliere extends EditRecord
{
    protected static string $resource = FiliereResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
