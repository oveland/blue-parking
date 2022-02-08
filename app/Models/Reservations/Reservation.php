<?php

namespace App\Models\Reservations;

use App\Models\ParkingLot\ParkingType;
use App\Models\ParkingLot\ParkingZone;
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
 * @property Carbon|string|null $start
 * @property Carbon|string|null $end
 * @property Carbon|string $hold_start
 * @property Carbon|string|null $hold_end
 * @property int $hold_timeout
 * @property bool $active
 * @property int $vehicle_id
 * @property int $reservation_type_id
 * @property-read ParkingType $type
 * @property-read ParkingZone $zone
 * @property-read Vehicle $vehicle
 * @method static Builder|Reservation newModelQuery()
 * @method static Builder|Reservation newQuery()
 * @method static Builder|Reservation query()
 * @mixin Eloquent
 */
class Reservation extends Model
{
    use HasFactory;

    protected $dates = ['start', 'end', 'hold_start', 'hold_end'];

    protected $fillable = ['start', 'end', 'hold_start', 'hold_end', 'hold_timeout', 'vehicle_id', 'parking_type_id', 'parking_zone_id'];

    function type(): BelongsTo
    {
        return $this->belongsTo(ParkingType::class, 'parking_type_id');
    }

    function zone(): BelongsTo
    {
        return $this->belongsTo(ParkingZone::class, 'parking_zone_id');
    }

    function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    function isOpen(): bool
    {
        return !$this->end;
    }

    function isFinalized(): bool
    {
        return !!$this->end;
    }

    function finalize(): Reservation
    {
        if ($this->isOpen()) {
            $this->active = false;
            $this->end = Carbon::now();
        }

        return $this;
    }

    function getCharge() {

    }

    function toArray(): array
    {
        return [
            'id' => $this->id,
            'start' => $this->start->toDateTimeString(),
            'startHuman' => $this->start->format('Y-m-d h:i:s a'),

            'end' => $this->end?->toDateTimeString(),
            'endHuman' => $this->end?->format('Y-m-d h:i:s a'),

            'holdStart' => $this->hold_start?->toDateTimeString(),
            'holdStartHuman' => $this->hold_start?->format('Y-m-d h:i:s a'),

            'holdEnd' => $this->hold_end?->toDateTimeString(),
            'holdEndHuman' => $this->hold_end?->format('Y-m-d h:i:s a'),

            'holdTimeout' => $this->hold_timeout,
            'active' => $this->active,
            'type' => $this->type->toArray(),
            'zone' => $this->zone->toArray(),
            'vehicle' => $this->vehicle->toArray(),
            'status' => $this->status(),
            'updatedAt' => $this->updated_at->format('Y-m-d h:i:s a')
        ];
    }

    function status(): object
    {
        $name = 'Reserved';
        $color = 'yellow';

        if ($this->active) {
            if ($this->hold_end) {
                $name = 'Parked';
                $color = 'blue';
            }
        } else {
            $name = 'Finished';
            $color = 'green';
        }

        return (object)compact(['name', 'color']);
    }
}
