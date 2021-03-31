<?php


namespace App\Http\Services;


use App\Models\Property;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\UserPropertyRepositoryInterface;
use \Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;

class PropertyService implements PropertyServiceInterface
{
    private PropertyRepositoryInterface $property_repository;
    private UserPropertyRepositoryInterface $user_property_repository;
    private UserPropertyTypeServiceInterface $user_property_type_service;

    public function __construct(PropertyRepositoryInterface $property_repository, UserPropertyRepositoryInterface $user_property_repository, UserPropertyTypeServiceInterface $user_property_type_service)
    {
        $this->property_repository = $property_repository;
        $this->user_property_repository = $user_property_repository;
        $this->user_property_type_service = $user_property_type_service;
    }

    public function makePropertyToUser(array $property_data, Authenticatable $user) : Property
    {
        //make property
        $property = $this->property_repository->create($property_data);

        //get link type
        $link_type = $this->user_property_type_service->getCurrentUserOwningType($user->type_id);

        //link property to user
        $this->user_property_repository->linkUserToProperty($user->id, $property->id, $link_type);

        return $property;
    }
}
