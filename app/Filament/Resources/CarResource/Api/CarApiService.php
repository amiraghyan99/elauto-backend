<?php
namespace App\Filament\Resources\CarResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\CarResource;
use Illuminate\Routing\Router;


class CarApiService extends ApiService
{
    protected static string | null $resource = CarResource::class;

    public static function allRoutes(Router $router)
    {
        Handlers\CreateHandler::route($router);
        Handlers\UpdateHandler::route($router);
        Handlers\DeleteHandler::route($router);
        Handlers\PaginationHandler::route($router);
        Handlers\DetailHandler::route($router);
    }
}
