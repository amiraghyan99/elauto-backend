<?php

namespace App\Filament\Resources\CarMakeListResource\Pages;

use App\Filament\Resources\CarMakeListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarMakeList extends EditRecord
{
    protected static string $resource = CarMakeListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
