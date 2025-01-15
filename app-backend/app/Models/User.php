<?php

namespace App\Models;

// use App\Traits\BelongsToTenant;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
// use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Spatie\MediaLibrary\MediaCollections\Models\Media;
// use Spatie\MediaLibrary\Conversions\Manipulations;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id',
        'phone',
        'avatar'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted()
    {
        static::creating(function ($record) {
            if (Hash::info($record->password)['algo'] === null) {
                $record->password = Hash::make($record->password);
            }
        });

        static::updating(function ($record) {
            if ($record->password) {
                $record->password = Hash::make($record->password);
            }
        });

        // static::bootBelongsToTenant();
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // public function companies()
    // {
    //     return $this->belongsToMany(Company::class);
    // }
}
