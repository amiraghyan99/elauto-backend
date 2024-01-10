<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class CarMake extends Model
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

        return $this->hasMany(CarModel::class);
    }

    public function trims(): HasManyDeep
    {
        return $this->hasManyDeep(
            CarTrim::class,
            [CarModel::class],
            ['car_make_id', 'car_model_id']
        );
    }

    public function cars(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->trims()->select(),
            (new CarTrim)->cars()
        );
    }
}
