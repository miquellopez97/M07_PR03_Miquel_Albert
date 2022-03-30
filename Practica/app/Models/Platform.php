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

    public function apartment()
    {
        return $this->belongsToMany(apartment::class)
            ->withPivot('apartment_id');
    }
}
