<?php


namespace App\Http\Services;


class UserPropertyTypeService implements UserPropertyTypeServiceInterface
{
    public function getCurrentUserOwningType(int $user_type_id) : int
    {
        switch($user_type_id)
        {
            case 1:
                return 1;
            case 2:
                return 2;
            case 3:
                return 3;
            case 4:
                return 4;
        }
    }
}
