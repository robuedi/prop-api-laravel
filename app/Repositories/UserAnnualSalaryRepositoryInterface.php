<?php

namespace App\Repositories;

use App\Models\AnnualSalary;

interface UserAnnualSalaryRepositoryInterface
{
    public function create(int $user_id, float $amount) : AnnualSalary;
    public function getFirstByUserId(int $user_id) : ?AnnualSalary;
}
