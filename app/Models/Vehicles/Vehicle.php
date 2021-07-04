<?php

namespace App\Models\Vehicles;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function type()
    {
        return $this->belongsTo(VehicleType::class);
    }
}
