<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToTenant;

class Lead extends Model
{
    use SoftDeletes, BelongsToTenant;

    protected $fillable = [
        'kanban_board_column_id',
        'kanban_board_column_order',
        'title',
        'description',
        'status',
        'budget',
        'priority',
    ];

    public static function boot()
    {
        parent::boot();
        static::bootBelongsToTenant();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function kanbanBoardColumn()
    {
        return $this->belongsTo(KanbanBoardColumn::class);
    }

    public function notes()
    {
        return $this->hasMany(LeadNote::class);
    }

    public function participants()
    {
        return $this->hasMany(LeadParticipant::class);
    }

    public function statusHistory()
    {
        return $this->hasMany(LeadStatusHistory::class);
    }
}
