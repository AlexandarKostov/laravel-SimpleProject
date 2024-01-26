<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vehicle extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public $table = 'vehicle_models';
    protected $fillable = [
        'brand',
        'model',
        'plate_number',
        'insurance_date',
    ];
    public  function vehicle(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
