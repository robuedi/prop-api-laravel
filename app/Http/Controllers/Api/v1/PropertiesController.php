<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserPropertyStoreRequest;
use App\Http\Resources\v1\PropertyResource;
use App\Http\Resources\GeneralResource;
use App\Models\Property;
use App\Models\User;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\Repositories\Params\PropertyRepositoryIndexParamInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PropertiesController extends Controller
{
    private PropertyRepositoryInterface $property_repository;

    public function __construct(PropertyRepositoryInterface $property_repository)
    {
        $this->property_repository = $property_repository;
    }

    public function index(PropertyRepositoryIndexParamInterface $index_param, Request $request)
    {
        //set params
        $index_param
            ->setAddress($request->get('has_address'))
            ->setCity($request->get('has_city'))
            ->setCountry($request->get('has_country'))
            ->setFields($request->get('fields'))
            ->setUserType($request->get('has_user_type') ? true : false)
            ->setUserId($request->has('has_current_user') ? auth()->id() : null);

        return PropertyResource::collection(
            $this->property_repository->index($index_param)
        )->response()->setStatusCode(Response::HTTP_OK);
    }

    public function indexForUser(User $user, Request $request)
    {
        return GeneralResource::collection($user->ownedProperties)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function indexForUserApplications(User $user, Request $request)
    {
        return GeneralResource::collection($user->propertyApplications)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function storeForUser(User $user, UserPropertyStoreRequest $request)
    {
        $property = $this->property_repository->createWithOptionalAddress(
            array_merge(['owner_id'=>$user->id],$request->all()),
            $request->get('address')
        );

        //make property for user
        return PropertyResource::make($property)->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Property $property)
    {
        return PropertyResource::make($property)->response()->setStatusCode(Response::HTTP_OK);
    }
}
