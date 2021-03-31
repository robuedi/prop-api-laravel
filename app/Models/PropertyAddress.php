<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'city_id',
        'address_line',
        'postcode',
    ];

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

}
