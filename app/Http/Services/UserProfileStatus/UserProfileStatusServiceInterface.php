<?php

namespace App\Http\Services\UserProfileStatus;

interface UserProfileStatusServiceInterface
{
    public function checkUserProfileCompleted(int $user_id): bool;
}
