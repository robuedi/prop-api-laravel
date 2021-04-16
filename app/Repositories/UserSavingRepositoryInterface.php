<?php

namespace App\Repositories;

use App\Models\Saving;

interface UserSavingRepositoryInterface
{
    public function getFirstByUserId(int $user_id): ?Saving;
}
