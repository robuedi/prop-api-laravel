<?php

namespace App\Repositories;

interface RoleUserRepositoryInterface
{
    public function makeCompleted(int $user_role_id);
}
