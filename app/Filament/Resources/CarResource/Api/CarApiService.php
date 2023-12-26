<?php

namespace App\Filament\Resources\CarResource\Api;

use App\Filament\Resources\CarResource;
use Illuminate\Routing\Router;
use Rupadana\ApiService\ApiService;

class CarApiService extends ApiService
{
    protected static ?string $resource = CarResource::class;

    public static function allRoutes(Router $router): void
    {
        //        Handlers\CreateHandler::route($router);
        //        Handlers\UpdateHandler::route($router);
        //        Handlers\DeleteHandler::route($router);
        Handlers\PaginationHandler::route($router);
        Handlers\DetailHandler::route($router);
    }
}
