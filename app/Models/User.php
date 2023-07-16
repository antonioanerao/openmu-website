<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

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
     * Changes the defaul email column name to the
     * reset password method
     *
     * @return string
     */
    public function getEmailForPasswordReset(): string
    {
        return $this->EMail;
    }

    /**
     * Override the routeNotificationFor method to use
     * the custom email column name. It is needed to
     * send the e-mail reset password link
     */
    public function routeNotificationFor($driver)
    {
        if (method_exists($this, $method = 'routeNotificationFor'.Str::studly($driver))) {
            return $this->{$method}();
        }

        switch ($driver) {
            case 'database':
                return $this->notifications();
            case 'mail':
                return $this->EMail;
            case 'nexmo':
                return $this->phone_number;
        }
    }

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
