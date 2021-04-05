<?php


namespace App\Repositories\Repositories;


use App\Models\PropertyUser;

class PropertyUserRepository
{
    private PropertyUser $property_user;

    public function __construct(PropertyUser $property_user)
    {
        $this->property_user = $property_user;
    }

    public function create($user_id, $property_id)
    {

    }
}
