<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\AgencyAddressResource;
use App\Http\Resources\v1\AgencyResource;
use App\Repositories\AgencyRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class AgenciesController extends Controller
{
    private AgencyRepositoryInterface $agency_repository;

    public function __construct(AgencyRepositoryInterface $agency_repository)
    {
        $this->agency_repository = $agency_repository;
    }

    public function storeForUser(Request $request)
    {
        //make property for user
        return AgencyResource::make(
            $this->agency_repository->create(auth()->user()->id, $request->get('name'), $request->has('is_public') ? 1 :0)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showForUser()
    {
        //make property for user
        return AgencyResource::make(
            $this->agency_repository->getFirstByUserId(auth()->user()->id)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }


}
