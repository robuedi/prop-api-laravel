<?php

namespace App\Http\Services\RoleUserStatus;

use App\Models\RoleUser;

interface RoleUserStatusServiceInterface
{
    public function checkRoleUserCompleted(int $user_id, RoleUser $role_user): bool;
}
