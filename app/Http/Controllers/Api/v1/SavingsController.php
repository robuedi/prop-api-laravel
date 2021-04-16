<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RoleUserSavingsIndexRequest;
use App\Http\Requests\v1\RoleUserSavingsStoreRequest;
use App\Http\Resources\v1\SavingResource;
use App\Models\RoleUser;
use Illuminate\Http\Response;

class SavingsController extends Controller
{
    public function store(RoleUser $role_user, RoleUserSavingsStoreRequest $request)
    {
        //make property for user
        return SavingResource::make(
            $role_user->savings->create($request->get('amount'))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function index(RoleUser $role_user, RoleUserSavingsIndexRequest $request)
    {
        //make property for user
        return SavingResource::collection(
            $role_user->savings
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
