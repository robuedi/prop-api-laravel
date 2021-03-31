<?php

namespace App\Http\Services;

use App\Models\Property;
use \Illuminate\Contracts\Auth\Authenticatable;

interface PropertyFacadeServiceInterface
{
    public function makeUserPropertyWithAddress(array $property_data, array $address_data, int $user_id, int $user_type_id) : Property;
}
