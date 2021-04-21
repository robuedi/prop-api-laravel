<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RolesUserStoreRequest;
use App\Http\Requests\v1\RolesUserUpdateRequest;
use App\Http\Resources\v1\RoleResource;
use App\Models\RoleUser;
use App\Models\User;
use App\Repositories\RoleUserRepositoryInterface;
use Illuminate\Http\Response;

class RolesUsersController extends Controller
{
    private RoleUserRepositoryInterface $role_user_repository;
    public function __construct(RoleUserRepositoryInterface $role_user_repository)
    {
        $this->role_user_repository = $role_user_repository;
    }

    public function update(RoleUser $roles_user, RolesUserUpdateRequest $request)
    {
        return RoleResource::make(
            $this->role_user_repository->updateInstance($roles_user, [
                'is_completed' => $request->get('is_completed'),
                'is_used' => $request->get('is_used')
            ])
        )->response()->setStatusCode(Response::HTTP_OK);
    }

    public function store(User $user, RolesUserStoreRequest $request)
    {
        return RoleResource::make(
            $user->userRole()->create(['role_id' => $request->get('role_id')])
        )->response()->setStatusCode(Response::HTTP_OK);
    }
}
