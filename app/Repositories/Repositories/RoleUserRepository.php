<?php


namespace App\Repositories\Repositories;

use App\Http\Services\RoleUserStatus\RoleUserStatusServiceInterface;
use App\Models\RoleUser;
use App\Repositories\RoleUserRepositoryInterface;

class RoleUserRepository implements RoleUserRepositoryInterface
{
    private RoleUserStatusServiceInterface $role_user_status_service;

    public function __construct(RoleUserStatusServiceInterface $role_user_status_service)
    {
        $this->role_user_status_service = $role_user_status_service;
    }

    public function updateInstance(RoleUser $roleUser, array $fields) : RoleUser
    {
        //only is_completed status is allowed to be updated
        if(isset($fields['is_completed']) && $roleUser->is_completed !== $fields['is_completed'])
        {
            $roleUser->update([
                'is_completed' => $this->role_user_status_service->getCompletedStatus($roleUser)
            ]);
        }

        //update is used
        if(isset($fields['is_used']))
        {
            $roleUser->update(['is_used' => $fields['is_used']]);

            if($fields['is_used'] === 1)
            {
                $roleUser->user->userRole()->where('id', '!=', $roleUser->id)->update(['is_used' => 0]);
            }
        }

        return $roleUser;
    }

}
