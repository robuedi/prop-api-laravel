<?php


namespace App\Repositories\Repositories;


use App\Models\RoleUser;
use App\Repositories\RoleUserRepositoryInterface;

class RoleUserRepository implements RoleUserRepositoryInterface
{
    private RoleUser $role_user;

    public function __construct(RoleUser $role_user)
    {
        $this->role_user = $role_user;
    }

    public function makeCompleted(int $user_role_id)
    {
        $this->role_user->where('id', $user_role_id)->update(['is_completed' => 1]);
    }

}
