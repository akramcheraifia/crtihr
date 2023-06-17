<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use Filament\Widgets\LineChartWidget;

class EmployenumChart extends LineChartWidget
{
    protected static ?string $heading = 'Stastique des fonctionnaires';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Nombre de fonctionnaires CRTI',
                    'data' => [4, 19, 16, 24, 33, 52, 78, 100, 140, 202],
                ],
            ],
            'labels' => ['1980', '1985', '1990', '1995', '2000', '2005', '2010', '2015', '2020', '2023', '2030', '2035'],
        ];
    }
}
