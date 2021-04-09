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
        return $this->country
                    ->with(['cities'])
                    ->get();
    }
}
