<?php

namespace App\Repositories;

use App\Models\Employment;

interface UserEmploymentRepositoryInterface
{
    public function getFirstByUserId(int $user_id): ?Employment;
}
