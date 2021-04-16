<?php

namespace App\Repositories;

use App\Models\Saving;

interface UserSavingRepositoryInterface
{
    public function create(int $user_id, float $amount): Saving;

    public function getFirstByUserId(int $user_id): ?Saving;
}
