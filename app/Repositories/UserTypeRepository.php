<?php


namespace App\Repositories;

use App\Models\UserType;

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
