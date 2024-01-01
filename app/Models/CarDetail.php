<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\CarDetail
 *
 * @property int $id
 * @property int $car_id
 * @property string $color
 * @property-read Car $car
 * @method static Builder|CarDetail newModelQuery()
 * @method static Builder|CarDetail newQuery()
 * @method static Builder|CarDetail query()
 * @method static Builder|CarDetail whereCarId($value)
 * @method static Builder|CarDetail whereColor($value)
 * @method static Builder|CarDetail whereId($value)
 * @property int|null $price
 * @method static Builder|CarDetail wherePrice($value)
 * @mixin \Eloquent
 */
class CarDetail extends Model
{
    public $timestamps = false;

    use HasFactory;

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
