<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
    ];

    public function address()
    {
        return $this->hasOne(PropertyAddress::class, 'property_id', 'id');
    }

    public function userProperty()
    {
        return $this->hasMAny(UserProperty::class, 'property_id', 'id');
    }
}
