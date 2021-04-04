<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $fillable = [
        'status_id',
        'owner_id',
        'name'
    ];

    public function address()
    {
        return $this->hasOne(PropertyAddress::class, 'property_id', 'id');
    }

    public function applicants()
    {
        return $this->belongsToMany(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function userType()
    {
        return $this->owner();
    }
}
