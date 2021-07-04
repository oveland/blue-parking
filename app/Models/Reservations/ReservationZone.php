<?php

namespace App\Models\Reservations;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Reservations\ReservationZone
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $code
 * @property int $reservation_type_id
 * @property-read ReservationType $type
 * @method static Builder|ReservationZone newModelQuery()
 * @method static Builder|ReservationZone newQuery()
 * @method static Builder|ReservationZone query()
 * @mixin Eloquent
 */
class ReservationZone extends Model
{
    use HasFactory;

    function type(): BelongsTo
    {
        return $this->belongsTo(ReservationType::class);
    }
}
