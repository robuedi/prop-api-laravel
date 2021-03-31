<?php


namespace App\Repositories\Repositories;

use App\Models\UserType;
use App\Repositories\UserTypeRepositoryInterface;

class UserTypeRepository implements UserTypeRepositoryInterface
{
    private UserType $user_type;

    public function __construct(UserType $user_type)
    {
        $this->user_type = $user_type;
    }

    public function index()
    {

        $query = $this->user_type::query();

        if(request()->get('fields'))
        {
            $query->select(explode(',', request()->get('fields')));
        }

        return $query->get();
    }
}
