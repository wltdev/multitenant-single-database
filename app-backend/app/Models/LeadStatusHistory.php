<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToTenant;

class LeadStatusHistory extends Model
{
    use SoftDeletes, BelongsToTenant;

    protected $table = 'lead_status_history';
    protected $fillable = [
        'lead_id',
        'status',
        'changed_at',
        'changed_by'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
