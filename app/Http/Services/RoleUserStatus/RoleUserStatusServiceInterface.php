<?php

namespace App\Http\Services\RoleUserStatus;

use App\Models\RoleUser;

interface RoleUserStatusServiceInterface
{
    public function getCompletedStatus(RoleUser $role_user) : int;
}
