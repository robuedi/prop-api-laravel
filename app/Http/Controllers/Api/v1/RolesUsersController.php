<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RolesUserStoreRequest;
use App\Http\Requests\v1\UserCheckProfileCompletedRequest;
use App\Http\Resources\v1\RoleResource;
use App\Http\Services\RoleUserStatus\RoleUserStatusServiceInterface;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Response;

class RolesUsersController extends Controller
{
    use ApiResponse;

    private RoleUserStatusServiceInterface $role_user_status_service;
    public function __construct(RoleUserStatusServiceInterface $role_user_status_service)
    {
        $this->role_user_status_service = $role_user_status_service;
    }

    public function checkRoleUserComplete(User $user, RoleUser $role_user, UserCheckProfileCompletedRequest $request)
    {
        return $this->apiResponse([
            'status' => $this->role_user_status_service->checkRoleUserCompleted($user->id, $role_user)
        ], Response::HTTP_OK);
    }

    public function storeForUser(User $user, RolesUserStoreRequest $request)
    {
        return RoleResource::make(
            $user->userRole()->create(['role_id' => $request->get('role_id')])
        )->response()->setStatusCode(Response::HTTP_OK);
    }
}
