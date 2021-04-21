<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'type'
    ];

    public function property()
    {
        return $this->belongsToOne(Property::class);
    }
}
