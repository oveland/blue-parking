<?php

namespace App\Models\ParkingLot;

use App\Models\Reservations\Reservation;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * App\Models\ParkingLot\ParkingZone
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $code
 * @property bool $available
 * @property int $parking_type_id
 * @property-read ParkingType $type
 * @method static Builder|ParkingZone forParking($id)
 * @method static Builder|ParkingZone newModelQuery()
 * @method static Builder|ParkingZone newQuery()
 * @method static Builder|ParkingZone query()
 * @mixin Eloquent
 * @method static Builder|ParkingZone available()
 */
class ParkingZone extends Model
{
    use HasFactory;

    function type(): BelongsTo
    {
        return $this->belongsTo(ParkingType::class, 'parking_type_id', 'id');
    }

    function reservations(): HasMany|Collection|Reservation
    {
        return $this->hasMany(Reservation::class);
    }

    function scopeAvailable(Builder $query): Builder|ParkingZone
    {
        return $query->where('available', true);
    }

    function scopeForParking(Builder $query, $id = 'any'): Builder|ParkingZone
    {
        return $query->whereHas('type', function (Builder $query) use ($id) {
            if ($id && $id != 'any') return $query->where('parking_id', $id);

            return $query;
        })->orderBy('code');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'available' => $this->available,
            'parking' => $this->type->parking,
            'totalReservations' => $this->reservations()->statusQuery('active')->dateStartQuery(Carbon::now()->toDateString())->count()
        ];
    }
}
