<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RoleUserAgencyAddressShowRequest;
use App\Http\Requests\v1\UserAgencyAddressStoreRequest;
use App\Http\Resources\v1\AgencyAddressResource;
use App\Models\Agency;
use App\Models\AgencyAddress;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Response;

class AgencyAddressesController extends Controller
{
    public function storeForRoleUserAgency(User $user, RoleUser $role_user, Agency $agency, RoleUserAgencyAddressStoreRequest $request)
    {
        $agency_address = AgencyAddress::create([
            'agency_id' => $agency->id,
            'city_id' => $request->get('city_id'),
            'address_line' => $request->get('address_line'),
            'postcode' => $request->get('postcode')
        ]);

        //make property for user
        return AgencyAddressResource::make($agency_address)->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showForRoleUserAgency(User $user, RoleUser $role_user, Agency $agency, RoleUserAgencyAddressShowRequest $request)
    {
        //make property for user
        return AgencyAddressResource::make($agency->address)->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
