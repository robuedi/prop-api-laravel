<?php


namespace App\Http\Controllers\Api\v1\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserRolesIndexRequest;
use App\Http\Resources\v1\RoleResource;
use App\Models\User;
use Illuminate\Http\Response;

class UserRolesController extends Controller
{
    public function index(User $user, UserRolesIndexRequest $request)
    {
        return RoleResource::collection($user->roles)->response()->setStatusCode(Response::HTTP_OK);
    }
}
