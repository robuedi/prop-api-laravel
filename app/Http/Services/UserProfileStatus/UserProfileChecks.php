<?php


namespace App\Http\Services\UserProfileStatus;


use App\Repositories\UserAddressRepositoryInterface;
use App\Repositories\UserAnnualSalaryRepositoryInterface;
use App\Repositories\UserEmploymentRepositoryInterface;
use App\Repositories\UserRentRepositoryInterface;
use App\Repositories\UserSavingRepositoryInterface;
use Illuminate\Support\Facades\Log;

class UserProfileChecks implements UserProfileChecksInterface
{
    public UserEmploymentRepositoryInterface $user_employment_repository;
    public UserAnnualSalaryRepositoryInterface $user_annual_salary_repository;
    public UserAddressRepositoryInterface $user_address_repository;
    public UserRentRepositoryInterface $user_rent_repository;
    public UserSavingRepositoryInterface $user_savings_repository;

    public function __construct(
                                UserEmploymentRepositoryInterface $user_employment_repository,
                                UserAddressRepositoryInterface $user_address_repository,
                                UserRentRepositoryInterface $user_rent_repository,
                                UserAnnualSalaryRepositoryInterface $user_annual_salary_repository,
                                UserSavingRepositoryInterface $user_savings_repository)
    {
        $this->user_employment_repository = $user_employment_repository;
        $this->user_annual_salary_repository = $user_annual_salary_repository;
        $this->user_address_repository = $user_address_repository;
        $this->user_rent_repository = $user_rent_repository;
        $this->user_savings_repository = $user_savings_repository;
    }
    public function checkEmployment(int $user_id) : bool
    {
        return $this->user_employment_repository->getFirstByUserId($user_id) ? true :false;
    }

    public function checkAnnualSalary(int $user_id) : bool
    {
        return $this->user_annual_salary_repository->getFirstByUserId($user_id) ? true :false;
    }

    public function checkRent(int $user_id) : bool
    {
        return $this->user_annual_salary_repository->getFirstByUserId($user_id) ? true :false;
    }

    public function checkAddress(int $user_id) : bool
    {
        return $this->user_annual_salary_repository->getFirstByUserId($user_id) ? true :false;
    }

    public function checkSavings(int $user_id) : bool
    {
        return $this->user_savings_repository->getFirstByUserId($user_id) ? true :false;
    }
}
