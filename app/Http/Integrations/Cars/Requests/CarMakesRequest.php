<?php

namespace App\Http\Integrations\Cars\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class CarMakesRequest extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/';
    }

    protected function defaultQuery(): array
    {
        return [
            'select' => 'make, model, basemodel',
            'group_by' => 'make, model, basemodel',
            'where' => 'fueltype like "Electricity"',
            'order_by' => 'make ASC, basemodel ASC'
        ];
    }
}
