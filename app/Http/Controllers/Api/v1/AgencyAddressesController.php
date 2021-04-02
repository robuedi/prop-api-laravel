<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserAgencyAddressShowRequest;
use App\Http\Requests\v1\UserAgencyAddressStoreRequest;
use App\Http\Resources\v1\AgencyAddressResource;
use App\Models\Agency;
use App\Models\User;
use App\Repositories\AgencyAddressRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AgencyAddressesController extends Controller
{
    private AgencyAddressRepositoryInterface $agency_address_repository;

    public function __construct(AgencyAddressRepositoryInterface $agency_address_repository)
    {
        $this->agency_address_repository = $agency_address_repository;
    }

    public function storeForUserAgency(User $user, Agency $agency, UserAgencyAddressStoreRequest $request)
    {
        //make property for user
        return AgencyAddressResource::make(
            $this->agency_address_repository->create(
                $agency->id,
                $request->get('city_id'),
                $request->get('address_line'),
                $request->get('postcode')
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showForUserAgency(User $user, Agency $agency, UserAgencyAddressShowRequest $request)
    {
        //make property for user
        return AgencyAddressResource::make(
            $this->agency_address_repository->getFirstByAgencyId($agency->id)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
