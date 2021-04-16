<?php

namespace App\Repositories;

use App\Models\RoleUserAddress;

interface UserAddressRepositoryInterface
{
    public function create(int $user_id, int $city_id, string $address_line, string $postcode): RoleUserAddress;

    public function getFirstByUserId(int $user_id): ?RoleUserAddress;
}
