<?php


namespace App\Repositories;


use App\Models\UserProperty;

class UserPropertyRepository implements UserPropertyRepositoryInterface
{
    private UserProperty $user_property;
    public function __construct(UserProperty $user_property)
    {
        $this->user_property = $user_property;
    }

    public function linkUserToProperty(int $user_id, int $property_id, int $type_id) : UserProperty
    {
        return $this->user_property->create([
            'user_id' => $user_id,
            'property_id' => $property_id,
            'type_id' => $type_id,
        ]);
    }
}
