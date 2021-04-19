<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RoleUserRentIndexRequest;
use App\Http\Requests\v1\RoleUserRentStoreRequest;
use App\Http\Resources\v1\RentResource;
use App\Models\RoleUser;
use Illuminate\Http\Response;

class RentsController extends Controller
{
    public function store(RoleUser $role_user, RoleUserRentStoreRequest $request)
    {
        //make property for user
        return RentResource::make(
            $role_user->rent()->create($request->only('amount'))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function index(RoleUser $role_user, RoleUserRentIndexRequest $request)
    {
        //make property for user
        return RentResource::collection($role_user->rent)->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
