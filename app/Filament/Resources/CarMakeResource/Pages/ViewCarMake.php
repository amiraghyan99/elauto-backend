<?php

namespace App\Filament\Resources\CarMakeResource\Pages;

use App\Filament\Resources\CarMakeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCarMake extends ViewRecord
{
    protected static string $resource = CarMakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
