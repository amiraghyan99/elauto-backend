<?php

namespace App\Filament\Resources\CarFeaturesResource\Pages;

use App\Filament\Resources\CarFeaturesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarFeatures extends EditRecord
{
    protected static string $resource = CarFeaturesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
