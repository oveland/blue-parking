<?php

namespace App\Models\Reservations;

use App\Models\ParkingLot\ParkingZone;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * App\Models\Reservations\RotationCheck
 *
 * @property int $id
 * @property Carbon|string $start
 * @property Carbon|string|null $finish
 * @property float|null $start_latitude
 * @property float|null $start_longitude
 * @property string|null $finish_latitude
 * @property string|null $finish_longitude
 * @property bool $completed
 * @property int|null $parking_zone_id
 * @property Reservation[]|Collection|null $reservations
 * @method static Builder|RotationCheck current()
 * @method static Builder|RotationCheck zoneQuery($zone = 'any')
 * @method static Builder|RotationCheck completed($status)
 * @method static Builder|RotationCheck started()
 * @method static Builder|RotationCheck finished()
 * @method static Builder|RotationCheck newModelQuery()
 * @method static Builder|RotationCheck newQuery()
 * @method static Builder|RotationCheck query()
 * @mixin Eloquent
 */
class RotationCheck extends Model
{
    use HasFactory;

    protected $dates = ['start', 'finish'];
    protected $fillable = ['start', 'finish', 'start_latitude', 'start_longitude', 'finish_latitude', 'finish_longitude', 'parking_zone_id'];

    public $timestamps = false;

    function reservations(): HasMany|Collection
    {
        return $this->hasMany(Reservation::class);
    }

    function parkingZone(): BelongsTo|ParkingZone
    {
        return $this->belongsTo(ParkingZone::class);
    }

    function start($coords = null): RotationCheck
    {
        if (!$this->start) $this->start = Carbon::now();

        if ($coords) {
            $coords = collect($coords);
            $this->start_latitude = $coords->get('latitude');
            $this->start_longitude = $coords->get('longitude');
        }

        $this->finish = null;
        $this->completed = false;

        return $this;
    }

    function complete($coords = null): RotationCheck
    {
        if (!$this->finish) $this->finish = Carbon::now();

        if ($coords) {
            $coords = collect($coords);
            $this->finish_latitude = $coords->get('latitude');
            $this->finish_longitude = $coords->get('longitude');
        }
        $this->completed = true;

        return $this;
    }

    function scopeCompleted(Builder $query, $status): Builder
    {
        return $query->where('completed', $status);
    }

    function scopeStarted(Builder|RotationCheck $query): Builder
    {
        return $query->completed(false);
    }

    function scopeFinished(Builder|RotationCheck $query): Builder
    {
        return $query->completed(true);
    }

    function scopeCurrent(Builder|RotationCheck $query): Builder
    {
        return $query->orderByDesc('start');
    }

    function scopeZoneQuery(Builder $query, $zone = 'any'): Builder|RotationCheck
    {
        if ($zone != 'any' && $zone) {
            $query = $query->where('parking_zone_id', $zone);
        }

        return $query;
    }

    function isActive(): bool
    {
        return !$this->completed && $this->start;
    }

    function isFinished(): bool
    {
        return $this->completed && $this->finish;
    }

    function toArray(): array
    {
        return [
            'id' => $this->id,
            'start' => $this->start->toDateTimeString(),
            'finish' => $this->isFinished() ? $this->finish->toDateTimeString() : '',
            'isActive' => $this->isActive(),
            'isFinished' => $this->isFinished(),
        ];
    }
}
