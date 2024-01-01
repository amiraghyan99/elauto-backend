<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

/**
 * App\Models\CarMakeList
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $logo
 * @property-read Collection<int, \App\Models\Car> $cars
 * @property-read int|null $cars_count
 * @property-read Collection<int, \App\Models\CarModelList> $models
 * @property-read int|null $models_count
 * @method static Builder|CarMakeList newModelQuery()
 * @method static Builder|CarMakeList newQuery()
 * @method static Builder|CarMakeList query()
 * @method static Builder|CarMakeList whereId($value)
 * @method static Builder|CarMakeList whereLogo($value)
 * @method static Builder|CarMakeList whereName($value)
 * @method static Builder|CarMakeList whereSlug($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CarFeatureList[] $features
 * @property-read int|null $features_count
 * @mixin \Eloquent
 */
class CarMakeList extends Model
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

    public function models(): HasMany
    {

        return $this->hasMany(CarModelList::class, 'car_make_list_id');
    }

    public function features(): HasManyDeep
    {
        return $this->hasManyDeep(
            CarFeatureList::class,
            [CarModelList::class],
            ['car_make_list_id', 'car_model_list_id']
        );
    }

    public function cars(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->features()->select(),
            (new CarFeatureList)->cars()
        );
    }
}
