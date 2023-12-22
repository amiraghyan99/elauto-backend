<?php

namespace App\Filament\Resources\CarTypeListResource\Pages;

use App\Filament\Resources\CarTypeListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarTypeList extends EditRecord
{
    protected static string $resource = CarTypeListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
