<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner'
    ];

    public function apartmentPlatform()
    {
        return $this->belongsToMany(Apartment::class, 'platform__apartments', 'platform_id', 'apartment_id')->withPivot('premium', 'register_date');
    }
}
