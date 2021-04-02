<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserPropertyAddressShowRequest;
use App\Http\Requests\v1\UserPropertyAddressStoreRequest;
use App\Http\Resources\v1\PropertyAddressResource;
use App\Models\Property;
use App\Models\User;
use App\Repositories\PropertyAddressRepositoryInterface;
use Illuminate\Http\Response;

class PropertyAddressesController extends Controller
{
    private PropertyAddressRepositoryInterface $property_address_repository;

    public function __construct(PropertyAddressRepositoryInterface $property_address_repository)
    {
        $this->property_address_repository = $property_address_repository;
    }

    public function storeForUserProperty(User $user, Property $property, UserPropertyAddressStoreRequest $request)
    {
        //make property for user
        return PropertyAddressResource::make($this->property_address_repository->create(array_merge(['property_id'=>$property->id], $request->all())))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showForUserProperty(User $user, Property $property, UserPropertyAddressShowRequest $request)
    {
        return PropertyAddressResource::make($property->address()->first())->response()->setStatusCode(Response::HTTP_OK);
    }
}
