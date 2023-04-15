<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;
    protected static ?string $title = 'Créer une permission';
    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}

