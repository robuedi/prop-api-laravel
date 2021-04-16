<?php

namespace App\Repositories;

use App\Models\Rent;

interface UserRentRepositoryInterface
{
    public function create(int $user_id, float $amount): Rent;

    public function getFirstByUserId(int $user_id): ?Rent;
}
