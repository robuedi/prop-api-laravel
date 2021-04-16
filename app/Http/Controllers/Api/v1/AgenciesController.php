<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RoleUserAgencyIndexRequest;
use App\Http\Requests\v1\RoleUserAgencyStoreRequest;
use App\Http\Resources\v1\AgencyResource;
use App\Models\Agency;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Response;

class AgenciesController extends Controller
{
    public function storeForRoleUser(RoleUser $role_user, RoleUserAgencyStoreRequest $request)
    {
        //make property for user
        return AgencyResource::make($role_user->agency->create([
            'name'          => $request->get('name'),
            'is_public'     => $request->has('is_public') ? 1 :0
        ]))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function indexForRoleUser(RoleUser $role_user, RoleUserAgencyIndexRequest $request)
    {
        //make property for user
        return AgencyResource::make($role_user->agency)->response()->setStatusCode(Response::HTTP_CREATED);
    }


}
