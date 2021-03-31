<?php

namespace App\Http\Services;

interface UserPropertyTypeServiceInterface
{
    public function getCurrentUserOwningType(int $user_type_id): int;
}
