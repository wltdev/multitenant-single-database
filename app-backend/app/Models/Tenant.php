<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Hash;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function plans()
    {
        return $this->hasMany(TenantPlan::class);
    }
}
