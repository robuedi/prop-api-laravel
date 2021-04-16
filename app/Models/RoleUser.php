<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'role_user';

    protected $fillable = [
        'user_id',
        'role_id',
        'is_completed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function agency()
    {
        return $this->hasOne(Agency::class, 'role_user_id', 'id');
    }

    public function savings()
    {
        return $this->hasMany(Saving::class);
    }

    public function rent()
    {
        return $this->hasMany(Rent::class);
    }

    public function employment()
    {
        return $this->hasMany(Employment::class);
    }

    public function address()
    {
        return $this->hasMany(RoleUserAddress::class);
    }
}
