<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantPlan extends Model
{
    protected $fillable = [
        'tenant_id',
        'plan_id',
        'expires_at',
        'status'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
