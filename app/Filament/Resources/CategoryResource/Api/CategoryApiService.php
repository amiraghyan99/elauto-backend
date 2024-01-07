<?php

namespace App\Filament\Resources\CategoryResource\Api;

use App\Filament\Resources\CategoryResource;
use Illuminate\Routing\Router;
use Rupadana\ApiService\ApiService;

class CategoryApiService extends ApiService
{
    protected static ?string $resource = CategoryResource::class;

    public static function allRoutes(Router $router): void
    {
        //        Handlers\CreateHandler::route($router);
        //        Handlers\UpdateHandler::route($router);
        //        Handlers\DeleteHandler::route($router);
        Handlers\PaginationHandler::route($router);
        Handlers\DetailHandler::route($router);
    }
}
