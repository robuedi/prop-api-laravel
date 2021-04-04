<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserRolesIndexRequest;
use App\Http\Resources\v1\RoleResource;
use App\Repositories\RoleRepositoryInterface;
use Illuminate\Http\Response;

class RolesController extends Controller
{
    private RoleRepositoryInterface $role_repository;

    public function __construct(RoleRepositoryInterface $role_repository)
    {
        $this->role_repository = $role_repository;
    }

    public function index()
    {
        return RoleResource::collection($this->role_repository->index())->response()->setStatusCode(Response::HTTP_OK);
    }

    public function getForUser(User $user, UserRolesIndexRequest $request)
    {
        return RoleResource::collection($this->user->roles())->response()->setStatusCode(Response::HTTP_OK);
    }
}
