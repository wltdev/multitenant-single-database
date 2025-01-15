<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToTenant;

class ProjectFile extends Model
{
    use SoftDeletes, BelongsToTenant;

    protected $fillable = [
        'project_id',
        'name',
        'file_path',
        'sender_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
