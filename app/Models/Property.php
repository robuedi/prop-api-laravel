<?php

namespace App\Models;

use App\Models\traits\SlugConvertValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory, SlugConvertValue;

    protected $table = 'properties';
    protected $slug_source_field = 'name';

    protected $fillable = [
        'status_id',
        'role_user_id',
        'name'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->slug = $this->name;
    }

    public function address()
    {
        return $this->hasOne(PropertyAddress::class, 'property_id', 'id');
    }

    public function propertyApplicants()
    {
        return $this->belongsToMany(RoleUser::class);
    }

    public function images()
    {
        return $this->belongsToMany(MediaFile::class);
    }

    public function owner()
    {
        return $this->belongsTo(RoleUser::class, 'id');
    }

    public function userType()
    {
        return $this->role();
    }
}
