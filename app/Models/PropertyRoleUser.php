<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRoleUser extends Model
{
    use HasFactory;

    protected $table = 'property_role_user';

    protected $fillable = [
        'role_user_id',
        'property_id'
    ];
}
