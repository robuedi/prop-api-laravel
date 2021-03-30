<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\v1\CityResource;
use App\Repositories\CityRepositoryInterface;
use Illuminate\Http\Response;

class CitiesController
{
    private CityRepositoryInterface $city_repository;

    public function __construct(CityRepositoryInterface $city_repository)
    {
        $this->city_repository = $city_repository;
    }

    public function index()
    {
        return CityResource::collection($this->city_repository->index())->response()->setStatusCode(Response::HTTP_OK);
    }
}
