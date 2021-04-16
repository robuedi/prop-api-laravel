<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dob'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ownedProperties()
    {
        return $this->hasMany(Property::class, 'owner_id', 'id');
    }

    public function propertyApplications()
    {
        return $this->belongsToMany(Property::class);
    }

    public function userRole()
    {
        return $this->hasMany(RoleUser::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function savings()
    {
        return $this->hasMany(UserSaving::class);
    }

    public function rent()
    {
        return $this->hasMany(UserRent::class);
    }

    public function employment()
    {
        return $this->hasMany(UserEmployment::class);
    }

    public function address()
    {
        return $this->hasMany(UserAddress::class);
    }
}
