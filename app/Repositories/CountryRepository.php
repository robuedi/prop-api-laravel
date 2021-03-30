<?php


namespace App\Repositories;

use App\Models\Country;

class CountryRepository implements CountryRepositoryInterface
{
    private Country $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    public function index()
    {

        $query = $this->country::query();

        if(request()->get('fields'))
        {
            $query->select(explode(',', request()->get('fields')));
        }

        return $query->get();
    }
}
