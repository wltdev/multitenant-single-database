<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
