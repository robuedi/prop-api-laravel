<?php


namespace App\Repositories\Repositories;

use App\Models\Country;
use App\Repositories\CountryRepositoryInterface;

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
