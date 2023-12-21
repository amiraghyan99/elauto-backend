<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarFeatures extends Model
{
    public $timestamps = false;

    use HasFactory;

    public function carModel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function modelName(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarModel::class)->select('name');
    }
}
