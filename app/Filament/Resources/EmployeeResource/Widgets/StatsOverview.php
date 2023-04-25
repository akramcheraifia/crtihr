<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Fonctionnaires', Employee::count())
                ->icon('heroicon-o-user-group'),
                Card::make('Fonctionnaires de status active', Employee::where('status','active')->count())
                ->icon('heroicon-o-user-group'),
        Card::make('Fonctionnaires de status inactive', Employee::where('status','Inactive')->count())
            ->icon('heroicon-o-user-group')

        ];

    }
}
