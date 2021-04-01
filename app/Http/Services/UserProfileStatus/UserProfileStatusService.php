<?php


namespace App\Http\Services\UserProfileStatus;

use App\Http\Services\UserProfileStatus\UserProfileChecksInterface;
use App\Repositories\UserRepositoryInterface;

class UserProfileStatusService implements UserProfileStatusServiceInterface
{
    public UserRepositoryInterface $user_repository;
    public UserProfileChecksInterface $user_profile_checks;

    public function __construct(UserRepositoryInterface $user_repository, UserProfileChecksInterface $user_profile_checks)
    {
        $this->user_repository = $user_repository;
        $this->user_profile_checks = $user_profile_checks;
    }

    public function checkUserProfileCompleted(int $user_id) :bool
    {
        $user_type = $this->user_repository->getUserTypeById($user_id);

        switch ($user_type)
        {
            case 1:
                if(!$this->user_profile_checks->checkEmployment($user_id)
                    || !$this->user_profile_checks->checkAnnualSalary($user_id)
                    || !$this->user_profile_checks->checkRent($user_id)
                    || !$this->user_profile_checks->checkAddress($user_id))
                {
                    return false;
                }

                $this->user_repository->makeUserProfileCompleted($user_id);
                return true;

            case 2:
                if(!$this->user_profile_checks->checkEmployment($user_id)
                    || !$this->user_profile_checks->checkAnnualSalary($user_id)
                    || !$this->user_profile_checks->checkSavings($user_id)
                    || !$this->user_profile_checks->checkAddress($user_id))
                {
                    return false;
                }

                $this->user_repository->makeUserProfileCompleted($user_id);
                return true;
        }
    }




}
