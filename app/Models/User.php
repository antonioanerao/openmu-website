<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'data.Account';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Id', 'LoginName', 'VaultId', 'PasswordHash', 'SecurityCode', 'EMail',
        'RegistrationDate', 'State', 'TimeZone', 'VaultPassword', 'IsVaultExtended'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'PasswordHash', 'SecurityCode', 'VaultPassword', 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', 'password' => 'hashed', 'Id' => 'string',
        'VaultId' => 'string'
    ];

    /**
     * Return a list of all characters from this account
     *
     * @return HasMany
     */
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class, 'AccountId', 'Id');
    }
}
