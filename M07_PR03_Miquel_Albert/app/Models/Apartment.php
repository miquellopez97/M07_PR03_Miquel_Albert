<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city',
        'postal_code',
        'rented_price',
        'rented',
        'user_id'
    ];

    public function apartmentPlatform()
    {
        return $this->belongsToMany(Platform::class, 'platform__apartments', 'apartment_id', 'platform_id')->withPivot('premium', 'register_date');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
}
