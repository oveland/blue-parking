<?php

namespace App\Models\ParkingLot;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ParkingLot\Parking
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property float $latitude
 * @property float $longitude
 * @property string $address
 * @property string $description
 * @property bool $in_street
 * @property Carbon|null $deleted_at
 * @method static Builder|Parking newModelQuery()
 * @method static Builder|Parking newQuery()
 * @method static \Illuminate\Database\Query\Builder|Parking onlyTrashed()
 * @method static Builder|Parking query()
 * @method static \Illuminate\Database\Query\Builder|Parking withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Parking withoutTrashed()
 * @mixin Eloquent
 */
class Parking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'parking_lots';
}
