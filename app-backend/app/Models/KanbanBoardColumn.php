<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KanbanBoardColumn extends Model
{
    protected $fillable = [
        'kanban_board_id',
        'name',
        'order'
    ];

    public function kanbanBoard()
    {
        return $this->belongsTo(KanbanBoard::class);
    }

    // get tasks by type
    public function tasks()
    {
        if ($this->kanbanBoard->type) {
            return $this->hasMany(Lead::class, 'kanban_board_column_id', 'id');
        }

        return collect(); // Return an empty collection for non-lead types
    }
}
