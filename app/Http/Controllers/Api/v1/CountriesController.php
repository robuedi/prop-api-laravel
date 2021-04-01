<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CountryResource;
use App\Repositories\CountryRepositoryInterface;
use Illuminate\Http\Response;

class CountriesController extends Controller
{
    private CountryRepositoryInterface $country_repository;

    public function __construct(CountryRepositoryInterface $country_repository)
    {
        $this->country_repository = $country_repository;
    }

    public function index()
    {
        return CountryResource::collection($this->country_repository->index())->response()->setStatusCode(Response::HTTP_OK);
    }
}
