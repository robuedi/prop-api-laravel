<?php

namespace App\Http\Services\RoleUserStatus;

interface RoleUserStatusServiceInterface
{
    public function checkRoleUserCompleted(int $user_id, int $user_role_id): bool;
}
