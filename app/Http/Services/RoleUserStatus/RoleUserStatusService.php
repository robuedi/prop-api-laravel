<?php


namespace App\Http\Services\RoleUserStatus;

use App\Models\RoleUser;
use App\Repositories\RoleUserRepositoryInterface;

class RoleUserStatusService implements RoleUserStatusServiceInterface
{
    public RoleUserRepositoryInterface $role_user_repository;
    public RoleUserChecksInterface $user_profile_checks;

    public function __construct(RoleUserRepositoryInterface $role_user_repository, RoleUserChecksInterface $user_profile_checks)
    {
        $this->role_user_repository = $role_user_repository;
        $this->user_profile_checks = $user_profile_checks;
    }

    public function checkRoleUserCompleted(int $user_id, RoleUser $role_user) :bool
    {
        switch ($role_user->role_id)
        {
            case 1:
                if(!$this->user_profile_checks->checkEmployment($user_id)
                    || !$this->user_profile_checks->checkAnnualSalary($user_id)
                    || !$this->user_profile_checks->checkRent($user_id)
                    || !$this->user_profile_checks->checkAddress($user_id))
                {
                    return false;
                }

                $this->role_user_repository->makeCompleted($role_user->id);
                return true;

            case 2:
                if(!$this->user_profile_checks->checkEmployment($user_id)
                    || !$this->user_profile_checks->checkAnnualSalary($user_id)
                    || !$this->user_profile_checks->checkSavings($user_id)
                    || !$this->user_profile_checks->checkAddress($user_id))
                {
                    return false;
                }

                $this->role_user_repository->makeCompleted($role_user->id);
                return true;

            case 3:
            case 4:
                $agency = $this->user_profile_checks->checkAgency($user_id);
                if(!$agency
                    || !$this->user_profile_checks->checkAgencyAddress($agency->id))
                {
                    return false;
                }

                $this->role_user_repository->makeCompleted($role_user->id);
                return true;

            default:
                return false;
        }
    }




}
