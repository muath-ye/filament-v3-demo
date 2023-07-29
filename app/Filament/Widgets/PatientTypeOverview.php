<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class PatientTypeOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Cats', Patient::query()->where('type', 'cat')->count()),
            Card::make('Dogs', Patient::query()->where('type', 'dog')->count()),
            Card::make('Rabbits', Patient::query()->where('type', 'rabbit')->count()),
        ];
    }
}
