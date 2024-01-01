<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $phonecode
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, State> $states
 * @property-read int|null $states_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country wherePhonecode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'phonecode',
    ];

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
