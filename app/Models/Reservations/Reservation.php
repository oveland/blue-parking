<?php

namespace App\Models\Reservations;

use App\Models\Vehicles\Vehicle;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Reservations\Reservation
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $start
 * @property string|null $end
 * @property string $hold_start
 * @property string|null $hold_end
 * @property bool $active
 * @property int $vehicle_id
 * @property int $reservation_type_id
 * @property-read ReservationType $type
 * @property-read Vehicle $vehicle
 * @method static Builder|Reservation newModelQuery()
 * @method static Builder|Reservation newQuery()
 * @method static Builder|Reservation query()
 * @mixin Eloquent
 */
class Reservation extends Model
{
    use HasFactory;

    function type(): BelongsTo
    {
        return $this->belongsTo(ReservationType::class);
    }

    function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
