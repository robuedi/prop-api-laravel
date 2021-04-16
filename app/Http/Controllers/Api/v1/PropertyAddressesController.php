<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\PropertyAddressIndexRequest;
use App\Http\Requests\v1\PropertyAddressStoreRequest;
use App\Http\Resources\v1\PropertyAddressResource;
use App\Models\Property;
use Illuminate\Http\Response;

class PropertyAddressesController extends Controller
{
    public function storeForProperty(Property $property, PropertyAddressStoreRequest $request)
    {
        //make property for user
        return PropertyAddressResource::make($property->address->create($request->all()))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function indexForProperty(Property $property, PropertyAddressIndexRequest $request)
    {
        return PropertyAddressResource::collection($property->address())->response()->setStatusCode(Response::HTTP_OK);
    }
}
