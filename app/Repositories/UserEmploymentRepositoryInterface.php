<?php

namespace App\Repositories;

use App\Models\Employment;

interface UserEmploymentRepositoryInterface
{
    public function create(int $user_id, string $job_title, string $start_date, string $end_date): Employment;

    public function getFirstByUserId(int $user_id): ?Employment;
}
