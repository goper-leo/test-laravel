<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;

    const ADMIN = 'admin';
    const USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'password',
        'user_name',
        'avatar_url',
        'user_role',
        'registered_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Is the current user is regular?
     *
     * @return boolean
     * @author goper
     */
    public function isUser()
    {
        return $this->user_role == self::USER;
    }

    /**
     * Get is user
     * @return boolean
     */
    public function getIsUserAttribute()
    {
        return $this->isUser();
    }

    /**
     * Get users that role is regular user
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     * @author goper
     */
    public function scopeUser($query)
    {
        return $query->where('user_role', self::USER);
    }

    /**
     * Is the current user an admin?
     *
     * @return boolean
     * @author goper
     */
    public function isAdmin()
    {
        return $this->user_role == self::ADMIN;
    }

    /**
     * Is admin?
     * @return boolean
     */
    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    /**
     * Get users that are admins
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     * @author goper
     */
    public function scopeAdmin($query)
    {
        return $query->where('user_role', self::ADMIN);
    }
}
