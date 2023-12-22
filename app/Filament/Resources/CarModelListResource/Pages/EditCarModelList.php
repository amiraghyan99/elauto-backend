<?php

namespace App\Filament\Resources\CarModelListResource\Pages;

use App\Filament\Resources\CarModelListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarModelList extends EditRecord
{
    protected static string $resource = CarModelListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
