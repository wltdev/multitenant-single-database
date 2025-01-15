<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToTenant;
use App\Models\User;

class Company extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant;

    public $table = 'companies';

    protected $fillable = [
        'name',
        'trading_name',
        'identification_name',
        'tenant_id',

        'country',
        'zipcode',
        'province',
        'city',
        'neighborhood',
        'street',
        'number',
        'complement',

        'phone1',
        'phone2',
        'email',
        'site',

        'cnae',
        'cnpj',
        'state_registration',
        'state_registration_tax_replacement',
        'city_registration',
        'suframa',

        'headquarter', // Se é matriz
        'status',
        'plan_id',
    ];

    public static function boot()
    {
        parent::boot();
        static::bootBelongsToTenant();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
