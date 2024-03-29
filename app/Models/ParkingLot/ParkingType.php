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
 * @property int $version
 * @property int $vehicle_type_id
 * @property int $parking_id
 * @property-read Parking $parking
 * @property-read VehicleType $vehicleType
 * @property-read Collection|ParkingZone[] $zones
 * @method static Builder|ParkingZone forParking($id)
 * @method static Builder|ParkingType parkingQuery($parking = 'any')
 * @method static Builder|ParkingType newModelQuery()
 * @method static Builder|ParkingType newQuery()
 * @method static Builder|ParkingType query()
 * @mixin Eloquent
 */
class ParkingType extends Model
{
    use HasFactory;

    protected $fillable = ['tariff', 'holdTariff', 'vehicle_type_id', 'parking_id'];

    function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }

    function zones(): HasMany|ParkingZone
    {
        return $this->hasMany(ParkingZone::class);
    }

    function scopeParkingQuery(Builder $query, $parking = 'any'): Builder|ParkingType
    {
        if ($parking != 'any') {
            $query = $query->where('parking_id', $parking);
        }

        return $query;
    }

    function scopeForParking(Builder $query, $id = 'any'): Builder|ParkingType
    {
        if ($id && $id != 'any') return $query->where('parking_id', $id);

        return $query;
    }

    public function toArray(): array
    {
        $availableZones = $this->zones()->available()->get();

        return [
            'id' => $this->id,
            'tariff' => $this->tariff,
            'holdTariff' => $this->hold_tariff,
            'vehicleType' => $this->vehicleType->toArray(),
            'available' => $availableZones->count(),
            'version' => $this->version,
            'parkingName' => $this->parking->name,
            'availableZones' => $availableZones->toArray(),
        ];
    }
}
