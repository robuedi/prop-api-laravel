<?php


namespace App\Http\Services;


use App\Models\Property;
use App\Repositories\PropertyAddressRepositoryInterface;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\UserPropertyRepositoryInterface;
use \Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;

class PropertyFacadeService implements PropertyFacadeServiceInterface
{
    private PropertyRepositoryInterface $property_repository;
    private UserPropertyRepositoryInterface $user_property_repository;
    private PropertyAddressRepositoryInterface $property_address_repository;

    public function __construct(PropertyRepositoryInterface $property_repository, PropertyAddressRepositoryInterface $property_address_repository, UserPropertyRepositoryInterface $user_property_repository)
    {
        $this->property_repository = $property_repository;
        $this->user_property_repository = $user_property_repository;
        $this->property_address_repository = $property_address_repository;
    }

    public function makeUserPropertyWithAddress(array $property_data, array $address_data, int $user_id, int $user_type_id) : Property
    {
        //make property
        $property = $this->property_repository->create($property_data);
Log::info($address_data);
        //add property address
        $this->property_address_repository->create(array_merge(['property_id' => $property->id], $address_data));

        //link property to user
        $this->user_property_repository->linkUserToProperty($user_id, $property->id, $user_type_id);

        return $property;
    }
}