<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'room_type_id',
        'base_price',
        'weekend_price',
        'seasonal_price',
        'use_weekend_price',
        'use_seasonal_price',
        'capacity',
        'status',
        'floor_number',
        'description',
        'image',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'room_amenity')
            ->withPivot('quantity');
    }

}
