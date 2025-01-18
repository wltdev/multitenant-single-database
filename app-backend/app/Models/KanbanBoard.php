<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToTenant;

class KanbanBoard extends Model
{
    use SoftDeletes, BelongsToTenant;

    protected $fillable = [
        'type',
        'name',
        'description',
        'tenant_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::bootBelongsToTenant();
    }

    public function columns()
    {
        return $this->hasMany(KanbanBoardColumn::class); //->with('tasks');
    }
}
