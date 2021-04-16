<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'is_public'
    ];

    public function address()
    {
        return $this->hasOne(AgencyAddress::class);
    }
}
