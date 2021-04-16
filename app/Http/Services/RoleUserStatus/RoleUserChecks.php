<?php


namespace App\Http\Services\RoleUserStatus;


use App\Models\Employment;
use App\Repositories\AgencyAddressRepositoryInterface;
use App\Repositories\AgencyRepositoryInterface;
use App\Repositories\UserAddressRepositoryInterface;
use App\Repositories\UserAnnualSalaryRepositoryInterface;
use App\Repositories\UserEmploymentRepositoryInterface;
use App\Repositories\UserRentRepositoryInterface;
use App\Repositories\UserSavingRepositoryInterface;
use Illuminate\Support\Facades\Log;

class RoleUserChecks implements RoleUserChecksInterface
{
    private UserEmploymentRepositoryInterface $user_employment_repository;
    private UserAnnualSalaryRepositoryInterface $user_annual_salary_repository;
    private UserAddressRepositoryInterface $user_address_repository;
    private UserRentRepositoryInterface $user_rent_repository;
    private UserSavingRepositoryInterface $user_savings_repository;
    private AgencyRepositoryInterface $agency_repository;
    private AgencyAddressRepositoryInterface $agency_address_repository;

    public function __construct(
                                UserEmploymentRepositoryInterface $user_employment_repository,
                                UserAddressRepositoryInterface $user_address_repository,
                                UserRentRepositoryInterface $user_rent_repository,
                                UserAnnualSalaryRepositoryInterface $user_annual_salary_repository,
                                AgencyRepositoryInterface $agency_repository,
                                AgencyAddressRepositoryInterface $agency_address_repository,
                                UserSavingRepositoryInterface $user_savings_repository)
    {
        $this->user_employment_repository = $user_employment_repository;
        $this->user_annual_salary_repository = $user_annual_salary_repository;
        $this->user_address_repository = $user_address_repository;
        $this->user_rent_repository = $user_rent_repository;
        $this->user_savings_repository = $user_savings_repository;
        $this->agency_repository = $agency_repository;
        $this->agency_address_repository = $agency_address_repository;
    }
    public function checkEmployment(int $user_id) : ?Employment
    {
        return $this->user_employment_repository->getFirstByUserId($user_id);
    }

    public function checkAnnualSalary(int $user_id)
    {
        return $this->user_annual_salary_repository->getFirstByUserId($user_id);
    }

    public function checkRent(int $user_id)
    {
        return $this->user_rent_repository->getFirstByUserId($user_id);
    }

    public function checkAddress(int $user_id)
    {
        return $this->user_address_repository->getFirstByUserId($user_id);
    }

    public function checkSavings(int $user_id)
    {
        return $this->user_savings_repository->getFirstByUserId($user_id);
    }

    public function checkAgency(int $user_id)
    {
        return $this->agency_repository->getFirstByUserId($user_id);
    }

    public function checkAgencyAddress(int $agency_id)
    {
        return $this->agency_address_repository->getFirstByAgencyId($agency_id);
    }
}
