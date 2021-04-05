<?php


namespace App\Repositories\Repositories;

use App\Models\Role;
use App\Repositories\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    private Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index()
    {

        $query = $this->role::query();

        if(request()->get('fields'))
        {
            $query->select(explode(',', request()->get('fields')));
        }

        return $query->get();
    }
}
