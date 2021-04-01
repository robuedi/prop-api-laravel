<?php

namespace App\Repositories;

use App\Models\UserAnnualSalary;

interface UserAnnualSalaryRepositoryInterface
{
    public function create(int $user_id, float $amount) : UserAnnualSalary;
    public function getFirstByUserId(int $user_id) : ?UserAnnualSalary;
}
