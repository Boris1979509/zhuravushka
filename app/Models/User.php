<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $middle_name
 * @property string $email
 * @property string $phone
 * @property bool $phone_verified
 * @property string $verify_token
 * @property string $phone_verify_token
 * @property string $delivery_place
 * @property Carbon $phone_verify_token_expire
 */
class User extends Authenticatable
{

    use Notifiable;
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'last_name',
        'middle_name',
        'phone_verify_token',
        'phone_verified',
        'delivery_place',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at'       => 'datetime',
        'phone_verified'            => 'boolean',
        'phone_verify_token_expire' => 'datetime',
    ];

    /**
     * @param array $data
     * @return User
     */
    public static function register($data): self
    {
        return static::create($data);
    }


}
