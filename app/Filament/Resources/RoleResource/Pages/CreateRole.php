<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;
    protected static ?string $title = 'Créer un rôle';
    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
