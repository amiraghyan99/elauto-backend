<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CarMakeList extends Model
{
    use HasFactory, HasSlug;

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

    public function cars()
    {
        return $this->hasManyThrough(
            Car::class,
            CarModelList::class,
            'car_make_list_id',
            'car_model_list_id'
        );
    }
}
