<?php


namespace App\Repositories\Repositories;

use App\Models\UserAnnualSalary;
use App\Repositories\UserAnnualSalaryRepositoryInterface;

class UserAnnualSalaryRepository implements UserAnnualSalaryRepositoryInterface
{
    private UserAnnualSalary $user_annual_salary;

    public function __construct(UserAnnualSalary $user_annual_salary)
    {
        $this->user_annual_salary = $user_annual_salary;
    }

    public function create(int $user_id, float $amount) : UserAnnualSalary
    {
        return $this->user_annual_salary
            ->create(['user_id' => $user_id, 'amount' => $amount]);
    }

    public function getFirstByUserId(int $user_id) : ?UserAnnualSalary
    {
        return $this->user_annual_salary
            ->where(['user_id' => $user_id])
            ->first();
    }
}
