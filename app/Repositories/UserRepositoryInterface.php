<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getUserTypeById(int $user_id): ?int;
    public function makeUserProfileCompleted(int $user_id);
}
