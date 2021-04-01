<?php

namespace App\Repositories;

use App\Models\UserSaving;

interface UserSavingRepositoryInterface
{
    public function create(int $user_id, float $amount): UserSaving;

    public function getFirstByUserId(int $user_id): ?UserSaving;
}
