<?php


namespace App\Repositories;

use App\Models\PropertyStatus;

class PropertyStatusRepository implements PropertyStatusRepositoryInterface
{
    private PropertyStatus $property_status;

    public function __construct(PropertyStatus $property_status)
    {
        $this->property_status = $property_status;
    }

    public function index()
    {

        $query = $this->property_status::query();

        if(request()->get('fields'))
        {
            $query->select(explode(',', request()->get('fields')));
        }

        return $query->get();
    }
}
