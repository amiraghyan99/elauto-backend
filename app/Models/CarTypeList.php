<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CarTypeList
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @method static Builder|CarTypeList newModelQuery()
 * @method static Builder|CarTypeList newQuery()
 * @method static Builder|CarTypeList query()
 * @method static Builder|CarTypeList whereId($value)
 * @method static Builder|CarTypeList whereName($value)
 * @method static Builder|CarTypeList whereSlug($value)
 * @mixin \Eloquent
 */
class CarTypeList extends Model
{
    use HasFactory;
}
