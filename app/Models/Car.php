<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    public function carModelList(): BelongsTo
    {
        return $this->belongsTo(CarModelList::class);
    }

    public function carMakeList()
    {
        return $this->carModelList()->first()->carMakeList()->first();
    }
}
