<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'city_id',
        'address_line',
        'postcode'
    ];
}
