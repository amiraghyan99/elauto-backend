<?php

namespace App\Filament\Resources\CategoryResource\Api\Handlers;

use App\Filament\Resources\CategoryResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class DetailHandler extends Handlers
{
    public static ?string $uri = '/{slug}';

    public static ?string $resource = CategoryResource::class;

    protected static string $keyName = 'slug';

    public function handler($slug)
    {
        $model = static::getModel()::query();

        $query = QueryBuilder::for(
            $model->where(static::getKeyName(), $slug)
        )
            ->first();

        if (! $query) {
            return static::sendNotFoundResponse();
        }

        $transformer = static::getApiTransformer();

        return new $transformer($query);
    }
}
