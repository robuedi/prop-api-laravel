<?php


namespace App\Repositories\Repositories;

use App\Models\AnnualSalary;
use App\Repositories\UserAnnualSalaryRepositoryInterface;

class UserAnnualSalaryRepository implements UserAnnualSalaryRepositoryInterface
{
    private AnnualSalary $user_annual_salary;

    public function __construct(AnnualSalary $user_annual_salary)
    {
        $this->user_annual_salary = $user_annual_salary;
    }

    public function create(int $user_id, float $amount) : AnnualSalary
    {
        return $this->user_annual_salary
            ->create(['user_id' => $user_id, 'amount' => $amount]);
    }

    public function getFirstByUserId(int $user_id) : ?AnnualSalary
    {
        return $this->user_annual_salary
            ->where(['user_id' => $user_id])
            ->first();
    }
}
