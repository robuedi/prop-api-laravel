<?php


namespace App\Repositories\Repositories;


use App\Models\PropertyAddress;
use App\Repositories\PropertyAddressRepositoryInterface;

class PropertyAddressRepository implements PropertyAddressRepositoryInterface
{
    private PropertyAddress $property_address;

    public function __construct(PropertyAddress $property_address)
    {
        $this->property_address = $property_address;
    }

    public function create(array $data)
    {
        //make the property
        return $this->property_address::create($data);
    }
}
