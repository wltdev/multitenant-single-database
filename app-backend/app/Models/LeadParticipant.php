<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadParticipant extends Model
{

    protected $fillable = [
        'lead_id',
        'user_id',
        'role',
        'assigned_at'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
