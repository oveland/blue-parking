<?php

namespace App\Models\ParkingLot;

use App\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\ParkingLot\Operator
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $parking_id
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Operator newModelQuery()
 * @method static Builder|Operator newQuery()
 * @method static Builder|Operator query()
 * @mixin Eloquent
 * @property-read Parking|null $parking
 * @property-read User|null $user
 */
class Operator extends Model
{
    use HasFactory;

    function user(): BelongsTo|User
    {
        return $this->belongsTo(User::class);
    }

    function parking(): BelongsTo|Parking
    {
        return $this->belongsTo(Parking::class);
    }
}
