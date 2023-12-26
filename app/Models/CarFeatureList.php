<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Znck\Eloquent\Traits\BelongsToThrough;

/**
 * App\Models\CarFeatureList
 *
 * @property int $id
 * @property int $car_model_list_id
 * @property string|null $class
 * @property string|null $fuel_type
 * @property string|null $fuel_type_dscr
 * @property string|null $transmission
 * @property string|null $drive
 * @property string|null $eng_dscr
 * @property string $year
 * @property string|null $engine
 * @property string $time_charge_240
 * @property int|null $cylinders
 * @property int $start_stop
 * @property int $mpgdata
 * @property-read \App\Models\CarModelList|null $model
 *
 * @method static Builder|CarFeatureList newModelQuery()
 * @method static Builder|CarFeatureList newQuery()
 * @method static Builder|CarFeatureList query()
 * @method static Builder|CarFeatureList whereCarModelListId($value)
 * @method static Builder|CarFeatureList whereClass($value)
 * @method static Builder|CarFeatureList whereCylinders($value)
 * @method static Builder|CarFeatureList whereDrive($value)
 * @method static Builder|CarFeatureList whereEngDscr($value)
 * @method static Builder|CarFeatureList whereEngine($value)
 * @method static Builder|CarFeatureList whereFuelType($value)
 * @method static Builder|CarFeatureList whereFuelTypeDscr($value)
 * @method static Builder|CarFeatureList whereId($value)
 * @method static Builder|CarFeatureList whereMpgdata($value)
 * @method static Builder|CarFeatureList whereStartStop($value)
 * @method static Builder|CarFeatureList whereTimeCharge240($value)
 * @method static Builder|CarFeatureList whereTransmission($value)
 * @method static Builder|CarFeatureList whereYear($value)
 *
 * @mixin \Eloquent
 */
class CarFeatureList extends Model
{
    use BelongsToThrough;
    use HasFactory;

    public $timestamps = false;

    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModelList::class, 'car_model_list_id');
    }

    public function make(): \Znck\Eloquent\Relations\BelongsToThrough
    {
        return $this->belongsToThrough(
            CarMakeList::class,
            CarModelList::class,
            'car_make_list_id',
        );
    }
}
