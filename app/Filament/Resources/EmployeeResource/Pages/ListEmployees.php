<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;
    protected static ?string $title = 'Fonctionnaires';
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
