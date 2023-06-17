<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use App\Models\Employee;
use Filament\Widgets\DoughnutChartWidget;

class typeChart extends DoughnutChartWidget
{
    //Employee::where('status','active')->count(), Employee::where('status','Inactive')->count(), Employee::where('status','mis en disponibilité')->count(), Employee::where('status','Détacher')->count()
    protected static ?string $heading = 'Répartition du personnel CRTI';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Nombre de fonctionnaires CRTI',
                    'data' => [203, 134, 98],
                    'backgroundColor' => ['#3490dc', '#38c172', '#ffed4a'],

                ],
            ],
            'labels' => ['Cheraga', 'Annaba', 'Setif'],

        ];

    }
}
