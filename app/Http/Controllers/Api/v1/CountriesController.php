<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CountryResource;
use App\Models\Country;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = QueryBuilder::for(Country::class)
            ->allowedFields([
                'id', 'name',
                'cities.id', 'cities.country_id', 'cities.name',
            ])
            ->allowedIncludes(['cities'])
            ->get();

        return CountryResource::collection($countries)->response()->setStatusCode(Response::HTTP_OK);
    }
}
