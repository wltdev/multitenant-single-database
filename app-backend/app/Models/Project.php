<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToTenant;
use Spatie\Image\Manipulations;
// use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model // implements HasMedia
{
    use SoftDeletes, BelongsToTenant;

    protected $fillable = [
        'title',
        'description',
        'company_id',
        'client_id',
        'begin_date',
        'due_date',
        'status',
    ];

    public static function boot()
    {
        parent::boot();
        static::bootBelongsToTenant();
    }

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this
    //         ->addMediaConversion('preview')
    //         ->fit(Manipulations::FIT_CROP, 300, 300)
    //         ->nonQueued();
    // }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function comments()
    {
        return $this->hasMany(ProjectComment::class);
    }

    // public function files()
    // {
    //     return $this->hasMany(ProjectFile::class);
    // }

    public function members()
    {
        return $this->hasMany(ProjectMember::class)->with('user') // Load the related user
            ->select('user_id', 'role', 'project_id');
    }
}
