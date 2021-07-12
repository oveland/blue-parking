<?php

namespace App\Models\ParkingLot;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

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
        return $this->belongsTo(ParkingType::class);
    }

    function scopeAvailable(Builder $query): Builder|ParkingZone
    {
        return $query->where('available', true);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'available' => $this->available
        ];
    }
}
