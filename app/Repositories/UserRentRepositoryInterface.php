<?php

namespace App\Repositories;

use App\Models\Rent;

interface UserRentRepositoryInterface
{
    public function getFirstByUserId(int $user_id): ?Rent;
}
