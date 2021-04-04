<?php


namespace App\Http\Controllers\Api\v1;


class RolesUsersController extends Controller
{
    private RoleUserRepositoryInterface $role_repository;

    public function __construct(RoleUserRepositoryInterface $role_user_repository)
    {
        $this->role_user_repository = $role_user_repository;
    }
}
