<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Carbon;
use Znck\Eloquent\Traits\BelongsToThrough;

/**
 * App\Models\Car
 *
 * @property int $id
 * @property int $car_model_list_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read CarDetail|null $details
 * @property-read CarModelList|null $model
 *
 * @method static Builder|Car newModelQuery()
 * @method static Builder|Car newQuery()
 * @method static Builder|Car query()
 * @method static Builder|Car whereCarModelListId($value)
 * @method static Builder|Car whereCreatedAt($value)
 * @method static Builder|Car whereId($value)
 * @method static Builder|Car whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Car extends Model
{
    use BelongsToThrough;
    use HasFactory;

    public function make(): \Znck\Eloquent\Relations\BelongsToThrough
    {
        return $this->belongsToThrough(
            CarMakeList::class,
            CarModelList::class,
            'car_make_list_id',
        );
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModelList::class, 'car_model_list_id');
    }

    public function details(): HasOne
    {
        return $this->hasOne(CarDetail::class, 'car_id');
    }

    public function features(): HasOneThrough
    {
        return $this->hasOneThrough(
            CarFeatureList::class,
            CarModelList::class,
            'car_make_list_id',
        );
    }
}
