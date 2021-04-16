<?php

namespace App\Repositories;

use App\Models\RoleUser;

interface RoleUserRepositoryInterface
{
    public function updateInstance(RoleUser $roleUser, array $fields) : RoleUser;
}
