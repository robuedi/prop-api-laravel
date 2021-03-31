<?php

namespace App\Http\Services;

use App\Models\Property;
use \Illuminate\Contracts\Auth\Authenticatable;

interface PropertyServiceInterface
{
    public function makePropertyToUser(array $property_data, Authenticatable $user): Property;
}
