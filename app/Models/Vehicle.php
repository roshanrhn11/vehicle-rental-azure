<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicle_name',
        'vehicle_type',
        'brand',
        'model',
        'location',
        'price_per_day',
        'description',
        'image_path',
        'status',
    ];

    public function bookings()
{
    return $this->hasMany(Booking::class);
}
}