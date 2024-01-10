<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\EloquentHasManyDeep\HasOneDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class CarTrim extends Model
{
    use HasFactory;
    use HasRelationships;

    public $timestamps = false;

    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function make(): HasOneDeep
    {
        return $this->hasOneDeepFromReverse(
            (new CarMake())->trims()
        );
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
