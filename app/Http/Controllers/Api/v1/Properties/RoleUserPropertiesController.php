<?php


namespace App\Http\Controllers\Api\v1\Properties;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserPropertyStoreRequest;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\v1\PropertyResource;
use App\Models\RoleUser;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class RoleUserPropertiesController extends Controller
{
    private PropertyRepositoryInterface $property_repository;

    public function __construct(PropertyRepositoryInterface $property_repository)
    {
        $this->property_repository = $property_repository;
    }

    public function index(RoleUser $role_user)
    {
        $user_properties = QueryBuilder::for($role_user->properties()->getQuery())
            ->allowedFields([
                'id', 'name', 'slug', 'created_at',
                'address.id', 'address.city_id', 'address.property_id', 'address.postcode', 'address.address_line',
                'address.city.id', 'address.city.country_id', 'address.city.name',
                'address.city.country.id', 'address.city.country.name',
                'images.id', 'images.path',
            ])
            ->allowedIncludes(['address', 'address.city', 'address.city.country', 'images'])
            ->get();

        return GeneralResource::collection($user_properties)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function store(RoleUser $role_user, UserPropertyStoreRequest $request)
    {
        $property = $this->property_repository->createRelational(
            array_merge(['role_user_id'=>$role_user->id], $request->all()),
        );

        //make property for user
        return PropertyResource::make($property)->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
