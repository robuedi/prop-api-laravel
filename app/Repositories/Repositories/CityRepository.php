<?php


namespace App\Repositories\Repositories;

use App\Models\City;
use App\Repositories\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface
{
    private City $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function index()
    {

        $query = $this->city::query();

        //check if cities required
        if(request()->has('where_country_id'))
        {
            $query->where('country_id', request()->get('where_country_id'));
        }

        if(request()->get('fields'))
        {
            $query->select(explode(',', request()->get('fields')));
        }

        return $query->get();
    }
}
