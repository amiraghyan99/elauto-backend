<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CarModel extends Model
{
    use HasFactory, HasSlug;

    public $timestamps = false;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function carMake(): BelongsTo
    {
        return $this->belongsTo(CarMake::class);
    }

    public function carFeatures(): HasOne
    {
        return $this->hasOne(CarFeatures::class);
    }
}
