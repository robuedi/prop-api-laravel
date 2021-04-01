<?php

namespace App\Repositories;

use App\Models\UserRent;

interface UserRentRepositoryInterface
{
    public function create(int $user_id, float $amount): UserRent;

    public function getFirstByUserId(int $user_id): ?UserRent;
}
