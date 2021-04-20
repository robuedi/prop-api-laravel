<?php


namespace App\Http\Controllers\Api\v1\Properties;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RoleUserPropertyApplicationStoreRequest;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\v1\RoleUserAddressResource;
use App\Models\RoleUser;
use Illuminate\Http\Response;

class PropertyApplicationsController extends Controller
{
    public function index(RoleUser $role_user)
    {
        return GeneralResource::collection($role_user->appliedProperties)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function store(RoleUser $role_user, RoleUserPropertyApplicationStoreRequest $request)
    {
        //make property for user
        return GeneralResource::make(
            $role_user->propertiesApplications()->create($request->only(['property_id']))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
