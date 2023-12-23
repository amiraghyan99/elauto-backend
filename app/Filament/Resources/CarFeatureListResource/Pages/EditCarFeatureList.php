<?php

namespace App\Filament\Resources\CarFeatureListResource\Pages;

use App\Filament\Resources\CarFeatureListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarFeatureList extends EditRecord
{
    protected static string $resource = CarFeatureListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
