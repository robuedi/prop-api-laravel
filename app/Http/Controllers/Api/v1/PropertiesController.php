<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Requests\v1\PropertyStoreRequest;
use App\Http\Resources\v1\PropertyResource;
use App\Http\Services\PropertyServiceInterface;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Http\Response;

class PropertiesController
{
    private PropertyRepositoryInterface $property_repository;
    private PropertyServiceInterface $property_service;

    public function __construct(PropertyRepositoryInterface $property_repository, PropertyServiceInterface $property_service)
    {
        $this->property_repository = $property_repository;
        $this->property_service = $property_service;
    }

    public function index()
    {
        return PropertyResource::collection($this->property_repository->index())->response()->setStatusCode(Response::HTTP_OK);
    }

    public function store(PropertyStoreRequest $request)
    {
        return PropertyResource::make($this->property_service->makePropertyToUser($request->all(), auth()->user()))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
