<?php

namespace App\Models\ParkingLot;

use App\Models\Vehicles\VehicleType;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\ParkingLot\ParkingType
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
 * @property-read Collection|ParkingZone[] $zones
 * @method static Builder|ParkingType newModelQuery()
 * @method static Builder|ParkingType newQuery()
 * @method static Builder|ParkingType query()
 * @mixin Eloquent
 */
class ParkingType extends Model
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

    function zones(): HasMany
    {
        return $this->hasMany(ParkingZone::class);
    }
}
