<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Staudenmeir\EloquentHasManyDeep\HasOneDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

/**
 * App\Models\Car
 *
 * @property int $id
 * @property int $car_model_list_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read CarDetail|null $details
 * @property-read CarModel|null $model
 * @method static Builder|Car newModelQuery()
 * @method static Builder|Car newQuery()
 * @method static Builder|Car query()
 * @method static Builder|Car whereCarModelListId($value)
 * @method static Builder|Car whereCreatedAt($value)
 * @method static Builder|Car whereId($value)
 * @method static Builder|Car whereUpdatedAt($value)
 * @property int $car_trim_list_id
 * @property-read \App\Models\CarTrim|null $feature
 * @property-read \App\Models\CarMake|null $make
 * @method static Builder|Car whereCarFeatureListId($value)
 * @property-read \App\Models\CarDetail|null $detail
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\CarTrim|null $trim
 * @method static Builder|Car whereCarTrimListId($value)
 * @mixin Eloquent
 */
class Car extends Model
{
    use HasFactory;
    use HasRelationships;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function trim(): BelongsTo
    {
        return $this->belongsTo(CarTrim::class, 'car_trim_list_id');
    }

    public function model(): HasOneDeep
    {
        return $this->hasOneDeepFromReverse(
            (new CarModel())->cars()
        );
    }

    public function make(): HasOneDeep
    {
        return $this->hasOneDeepFromReverse(
            (new CarMake())->cars()
        );
    }

    public function detail()
    {
        return $this->hasOne(CarDetail::class);
    }
}
