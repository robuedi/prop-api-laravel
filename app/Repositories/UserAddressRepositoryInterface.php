<?php

namespace App\Repositories;

use App\Models\UserAddress;

interface UserAddressRepositoryInterface
{
    public function create(int $user_id, int $city_id, string $address_line, string $postcode): UserAddress;

    public function getFirstByUserId(int $user_id): ?UserAddress;
}
