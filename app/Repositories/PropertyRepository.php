<?php


namespace App\Repositories;


use App\Models\Property;

class PropertyRepository implements PropertyRepositoryInterface
{
    private Property $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function index()
    {

        $query = $this->property::query();

        if(request()->get('fields'))
        {
            $query->select(explode(',', request()->get('fields')));
        }

        return $query->get();
    }

    public function create(array $data)
    {
        //make the property
        return $this->property::create($data);
    }
}
