<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Tenant;
use Illuminate\Http\Request;

trait BelongsToTenant
{
    public static function bootBelongsToTenant()
    {
        static::creating(function ($model) {
            if (!$model->tenant_id && auth()->user()) {
                $model->tenant_id = auth()->user()->tenant_id;
            }
        });

        static::addGlobalScope('tenant', function (Builder $builder) {
            // Skip the scope during authentication
            if (request()->is('api/login') || request()->is('api/auth/*')) {
                return;
            }

            if (!auth()->user()) {
                return;
            }

            $builder->where('tenant_id', auth()->user()->tenant_id);
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function scopeForTenant(Builder $query, $tenantId = null)
    {
        $tenantId = $tenantId ?? auth()->user()?->tenant_id;
        return $query->where('tenant_id', $tenantId);
    }
}
