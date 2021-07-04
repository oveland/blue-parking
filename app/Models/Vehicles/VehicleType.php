<?php

namespace App\Models\Vehicles;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Vehicles\VehicleType
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property string|null $icon
 * @method static Builder|VehicleType newModelQuery()
 * @method static Builder|VehicleType newQuery()
 * @method static Builder|VehicleType query()
 * @mixin Eloquent
 */
class VehicleType extends Model
{
    use HasFactory;
}
