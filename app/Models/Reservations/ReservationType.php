<?php

namespace App\Models\Reservations;

use App\Models\ParkingLot\Parking;
use App\Models\Vehicles\VehicleType;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Reservations\ReservationType
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $tariff
 * @property int $hold_tariff
 * @property int $vehicle_type_id
 * @property int $parking_id
 * @property-read Parking $parking
 * @property-read VehicleType $vehicleType
 * @property-read ReservationZone|null $zone
 * @method static Builder|ReservationType newModelQuery()
 * @method static Builder|ReservationType newQuery()
 * @method static Builder|ReservationType query()
 * @mixin Eloquent
 */
class ReservationType extends Model
{
    use HasFactory;

    function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }

    function zone(): HasOne
    {
        return $this->hasOne(ReservationZone::class);
    }
}
