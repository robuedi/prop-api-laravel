<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RoleUserAgencyShowRequest;
use App\Http\Requests\v1\RoleUserAgencyStoreRequest;
use App\Http\Resources\v1\AgencyResource;
use App\Models\Agency;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Response;

class AgenciesController extends Controller
{
    public function storeForRoleUser(User $user, RoleUser $role_user, RoleUserAgencyStoreRequest $request)
    {
        $agency = Agency::create([
            'role_user_id'  => $role_user->id,
            'name'          => $request->get('name'),
            'is_public'     => $request->has('is_public') ? 1 :0
        ]);

        //make property for user
        return AgencyResource::make($agency)->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function indexForRoleUser(User $user, RoleUser $role_user, RoleUserAgencyShowRequest $request)
    {
        //make property for user
        return AgencyResource::make($role_user->agency)->response()->setStatusCode(Response::HTTP_CREATED);
    }


}
