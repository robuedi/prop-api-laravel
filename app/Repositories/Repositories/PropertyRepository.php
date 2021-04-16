<?php


namespace App\Repositories\Repositories;


use App\Models\Property;
use App\Repositories\PropertyRepositoryInterface;

class PropertyRepository implements PropertyRepositoryInterface
{
    private Property $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function createWithOptionalAddress(array $property_data, ?array $address_data)
    {
        //make the property
        $property = $this->property::create($property_data);

        //make address
        if(!empty($address_data))
        {
            $property->address()->create($address_data);
        }

        return $property;
    }
}
