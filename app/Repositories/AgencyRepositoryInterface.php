<?php

namespace App\Repositories;

use App\Models\Agency;

interface AgencyRepositoryInterface
{
    public function getFirstByUserId(int $user_id): ?Agency;
}
