<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadStatusHistory extends Model
{

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
