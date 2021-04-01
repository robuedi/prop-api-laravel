<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PropertyStatusResource;
use App\Repositories\PropertyStatusRepositoryInterface;
use Illuminate\Http\Response;

class PropertyStatusesController extends Controller
{
    private PropertyStatusRepositoryInterface $property_status_repository;

    public function __construct(PropertyStatusRepositoryInterface $property_status_repository)
    {
        $this->property_status_repository = $property_status_repository;
    }

    public function index()
    {
        return PropertyStatusResource::collection($this->property_status_repository->index())->response()->setStatusCode(Response::HTTP_OK);
    }
}
