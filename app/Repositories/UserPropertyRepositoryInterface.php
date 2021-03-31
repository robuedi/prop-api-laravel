<?php

namespace App\Repositories;

use App\Models\UserProperty;

interface UserPropertyRepositoryInterface
{
    public function linkUserToProperty(int $user_id, int $property_id, int $type_id) : UserProperty;
}
