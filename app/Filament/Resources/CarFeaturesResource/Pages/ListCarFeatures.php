<?php

namespace App\Filament\Resources\CarFeaturesResource\Pages;

use App\Filament\Resources\CarFeaturesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarFeatures extends ListRecords
{
    protected static string $resource = CarFeaturesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
