<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'duration_in_days',
        'lifetime',
        'active'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
