<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Car extends Model
{
    use HasFactory;

    public function make()
    {
        return $this->model->make();
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModelList::class, 'car_model_list_id');
    }

    public function details(): HasOne
    {
        return $this->hasOne(CarDetail::class, 'car_id');
    }

    public function features()
    {
        return $this->model->features();
    }
}
