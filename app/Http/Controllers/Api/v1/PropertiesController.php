<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Requests\v1\PropertyStoreRequest;
use App\Http\Resources\v1\PropertyAddressResource;
use App\Http\Resources\v1\PropertyResource;
use App\Http\Services\PropertyFacadeServiceInterface;
use App\Models\Property;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\Repositories\Params\PropertyRepositoryIndexParamInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertiesController
{
    private PropertyRepositoryInterface $property_repository;
    private PropertyFacadeServiceInterface  $property_facade_service;

    public function __construct(PropertyRepositoryInterface $property_repository, PropertyFacadeServiceInterface $property_facade_service)
    {
        $this->property_repository = $property_repository;
        $this->property_facade_service = $property_facade_service;
    }

    public function index(PropertyRepositoryIndexParamInterface $index_param, Request $request)
    {
        //set params
        $index_param
            ->setAddress($request->get('has_address'))
            ->setCity($request->get('has_city'))
            ->setCountry($request->get('has_country'))
            ->setFields($request->get('fields'))
            ->setUserId($request->has('has_current_user') ? auth()->id() : null);

        return PropertyResource::collection(
            $this->property_repository->index($index_param)
        )->response()->setStatusCode(Response::HTTP_OK);
    }

    public function store(PropertyStoreRequest $request)
    {
        //make property for user
        return PropertyResource::make(
            $this->property_facade_service->makeUserPropertyWithAddress(
                $request->all(),
                $request->get('address'),
                auth()->user()->id
            ))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Property $property)
    {
        return PropertyResource::make($property)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function showPropertyAddress(Property $property)
    {
        return PropertyAddressResource::make($property->address()->first())->response()->setStatusCode(Response::HTTP_OK);
    }
}
