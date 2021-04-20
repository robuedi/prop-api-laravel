<?php


namespace App\Http\Controllers\Api\v1\Properties;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserPropertyStoreRequest;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\v1\PropertyResource;
use App\Models\RoleUser;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Http\Response;

class RoleUserPropertiesController extends Controller
{
    private PropertyRepositoryInterface $property_repository;

    public function __construct(PropertyRepositoryInterface $property_repository)
    {
        $this->property_repository = $property_repository;
    }

    public function index(RoleUser $role_user)
    {
        return GeneralResource::collection($role_user->properties)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function store(RoleUser $role_user, UserPropertyStoreRequest $request)
    {
        $property = $this->property_repository->createWithOptionalAddress(
            array_merge(['role_user_id'=>$role_user->id],$request->all()),
            $request->get('address')
        );

        //make property for user
        return PropertyResource::make($property)->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
