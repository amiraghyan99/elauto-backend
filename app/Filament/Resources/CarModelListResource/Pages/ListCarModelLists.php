<?php

namespace App\Filament\Resources\CarModelListResource\Pages;

use App\Filament\Resources\CarModelListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarModelLists extends ListRecords
{
    protected static string $resource = CarModelListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
