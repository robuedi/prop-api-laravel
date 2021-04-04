<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id'
    ];
}
