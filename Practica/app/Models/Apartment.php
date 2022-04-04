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

    public function platform()
    {
        return $this->belongsToMany(Platform::class)
            ->withPivot('platform_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
}
