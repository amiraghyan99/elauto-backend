<?php

namespace App\Filament\Widgets;

use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Collection;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::query()->count())
                ->description('Users from the database')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart(Collection::times(10, fn() => rand(1, 50))->all()),

            Stat::make('Car Makes', CarMake::query()->count())
                ->description('Car Makes from the database')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart(Collection::times(10, fn() => rand(1, 50))->all()),

            Stat::make('Car Models', CarModel::query()->count())
                ->description('Car Models from the database')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart(Collection::times(10, fn() => rand(1, 50))->all()),
        ];
    }
}
