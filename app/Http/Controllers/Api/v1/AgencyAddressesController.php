<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\AgencyAddressIndexRequest;
use App\Http\Requests\v1\AgencyAddressStoreRequest;
use App\Http\Resources\v1\AgencyAddressResource;
use App\Models\Agency;
use Illuminate\Http\Response;

class AgencyAddressesController extends Controller
{
    public function index(Agency $agency, AgencyAddressIndexRequest $request)
    {
        //make property for user
        return AgencyAddressResource::collection($agency->addresses)->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function store(Agency $agency, AgencyAddressStoreRequest $request)
    {
        //make property for user
        return AgencyAddressResource::make(
            $agency->addresses()->create($request->only(['city_id', 'address_line', 'postcode']))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
