<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToTenant;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\MediaLibrary\MediaCollections\Models\Media;
// use Spatie\Image\Manipulations;

class Client extends Model implements HasMedia
{
    use SoftDeletes, BelongsToTenant, InteractsWithMedia;

    protected $fillable = [
        'company_id',
        'address_id',

        'name',
        'email',
        'phone',

        'person_number',
        'birthdate',
        'gender',
        'profession',

        'trading_name',
        'business_number',
        'state_registration',
        'city_registration',
        'suframa',
        'icms_contributor',

        'type',
        'active'
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

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }
}
