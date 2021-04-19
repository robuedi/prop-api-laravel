<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RoleUserAddressStoreRequest;
use App\Http\Resources\v1\RoleUserAddressResource;
use App\Models\RoleUser;
use Illuminate\Http\Response;

class RoleUserAddressesController extends Controller
{
    public function index(RoleUser $role_user)
    {
        //make property for user
        return RoleUserAddressResource::collection(
            $role_user->addresses
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function store(RoleUser $role_user, RoleUserAddressStoreRequest $request)
    {
        //make property for user
        return RoleUserAddressResource::make(
            $role_user->addresses()->create($request->only(['city_id','address_line', 'postcode']))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
