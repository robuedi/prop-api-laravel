<?php

namespace App\Repositories;

use App\Models\RoleUserAddress;

interface UserAddressRepositoryInterface
{
    public function getFirstByUserId(int $user_id): ?RoleUserAddress;
}
