<?php

namespace App\Models\Vehicles;

use App\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Vehicles\Vehicle
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $plate
 * @property string $color
 * @property string $model
 * @property int $vehicle_type_id
 * @property int $user_id
 * @property Carbon|null $deleted_at
 * @property-read VehicleType $type
 * @property-read User $user
 * @method static Builder|Vehicle newModelQuery()
 * @method static Builder|Vehicle newQuery()
 * @method static \Illuminate\Database\Query\Builder|Vehicle onlyTrashed()
 * @method static Builder|Vehicle query()
 * @method static \Illuminate\Database\Query\Builder|Vehicle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Vehicle withoutTrashed()
 * @mixin Eloquent
 */
class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['plate', 'color', 'model', 'vehicle_type_id', 'user_id'];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function type(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'plate' => $this->plate,
            'color' => $this->color,
            'model' => $this->model,
            'type' => $this->type->toArray(),
            'user' => [
                'name' => $this->user->name
            ]
        ];
    }
}
