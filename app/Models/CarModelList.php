<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

/**
 * App\Models\CarModelList
 *
 * @property int $id
 * @property int $car_make_list_id
 * @property int|null $car_type_list_id
 * @property string $name
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Car> $cars
 * @property-read int|null $cars_count
 * @property-read \App\Models\CarFeatureList|null $features
 * @property-read \App\Models\CarMakeList $make
 * @method static \Illuminate\Database\Eloquent\Builder|CarModelList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarModelList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarModelList query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarModelList whereCarMakeListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModelList whereCarTypeListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModelList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModelList whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModelList whereSlug($value)
 * @property-read int|null $features_count
 * @mixin \Eloquent
 */
class CarModelList extends Model
{
    use HasFactory, HasSlug;
    use HasRelationships;
    public $timestamps = false;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function make(): BelongsTo
    {
        return $this->belongsTo(CarMakeList::class, 'car_make_list_id');
    }

    public function features(): HasMany
    {
        return $this->hasMany(CarFeatureList::class, 'car_model_list_id');
    }

    public function cars(): HasManyDeep
    {
        return $this->hasManyDeep(
            Car::class,
            [CarFeatureList::class],
            ['car_model_list_id', 'car_feature_list_id']
        );
    }
}
