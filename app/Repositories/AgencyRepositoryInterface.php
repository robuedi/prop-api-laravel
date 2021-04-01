<?php

namespace App\Repositories;

use App\Models\Agency;

interface AgencyRepositoryInterface
{
    public function create(int $user_id, string $name, int $is_public): Agency;

    public function getFirstByUserId(int $user_id): ?Agency;
}
