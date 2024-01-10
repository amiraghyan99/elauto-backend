<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class CarModel extends Model
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
        return $this->belongsTo(CarMake::class);
    }

    public function trims(): HasMany
    {
        return $this->hasMany(CarTrim::class);
    }

    public function cars(): HasManyDeep
    {
        return $this->hasManyDeep(
            Car::class,
            [CarTrim::class],
            ['car_model_id', 'car_trim_id']
        );
    }
}
