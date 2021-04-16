<?php


namespace App\Http\Services\RoleUserStatus;

use App\Models\RoleUser;

class RoleUserStatusService implements RoleUserStatusServiceInterface
{
    public function getCompletedStatus(RoleUser $role_user) : int
    {
        switch ($role_user->role_id)
        {
            //tenant
            case 1:
                if($role_user->employment()->count() && $role_user->annualSalary()->count() && $role_user->rent()->count() && $role_user->address()->count())
                {
                    return 1;
                }

                return 0;

            //buyer
            case 2:
                if($role_user->employment()->count() && $role_user->annualSalary()->count() && $role_user->savings()->count() && $role_user->address()->count())
                {
                    return 1;
                }

                return 0;

            //seller & landlord
            case 3:
            case 4:
                $agency = $role_user->agency()->first();
                if($agency && $agency->address()->count())
                {
                    return 1;
                }

                return 0;

            default:
                return 0;
        }
    }




}
