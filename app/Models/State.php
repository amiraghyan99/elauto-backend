<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\State
 *
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, City> $cities
 * @property-read int|null $cities_count
 * @property-read Country $country
 * @method static Builder|State newModelQuery()
 * @method static Builder|State newQuery()
 * @method static Builder|State query()
 * @method static Builder|State whereCountryId($value)
 * @method static Builder|State whereCreatedAt($value)
 * @method static Builder|State whereId($value)
 * @method static Builder|State whereName($value)
 * @method static Builder|State whereUpdatedAt($value)
 * @mixin Eloquent
 */
class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'name',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
