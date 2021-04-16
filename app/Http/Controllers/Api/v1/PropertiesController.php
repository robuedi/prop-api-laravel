<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserPropertyStoreRequest;
use App\Http\Resources\v1\PropertyResource;
use App\Http\Resources\GeneralResource;
use App\Models\Property;
use App\Models\RoleUser;
use App\Models\User;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class PropertiesController extends Controller
{
    private PropertyRepositoryInterface $property_repository;

    public function __construct(PropertyRepositoryInterface $property_repository)
    {
        $this->property_repository = $property_repository;
    }

    public function index()
    {
        $properties = QueryBuilder::for(Property::class)
                ->allowedFields([
                    'id', 'name', 'slug', 'created_at',
                    'address.id', 'address.city_id', 'address.property_id', 'address.postcode', 'address.address_line',
                    'address.city.id', 'address.city.country_id', 'address.city.name',
                    'address.city.country.id', 'address.city.country.name',
                ])
                ->allowedIncludes(['address', 'address.city', 'address.city.country', 'userType'])
                ->get();

        return PropertyResource::collection($properties)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function indexForRoleUser(RoleUser $role_user, Request $request)
    {
        return GeneralResource::collection($role_user->ownedProperties)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function indexForRoleUserApplications(RoleUser $role_user, Request $request)
    {
        return GeneralResource::collection($role_user->propertyApplications)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function storeForRoleUser(RoleUser $role_user, UserPropertyStoreRequest $request)
    {
        $property = $this->property_repository->createWithOptionalAddress(
            array_merge(['role_user_id'=>$role_user->id],$request->all()),
            $request->get('address')
        );

        //make property for user
        return PropertyResource::make($property)->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Property $property)
    {
        $_property = QueryBuilder::for($property)
            ->allowedFields([
                'id', 'name', 'slug', 'type_id', 'created_at',
                'address.id', 'address.city_id', 'address.property_id', 'address.postcode', 'address.address_line',
                'address.city.id', 'address.city.country_id', 'address.city.name',
                'address.city.country.id', 'address.city.country.name',
                'type.id', 'type.name',
            ])
            ->allowedIncludes(['address', 'address.city', 'address.city.country', 'type'])
            ->first();

        return PropertyResource::make($_property)->response()->setStatusCode(Response::HTTP_OK);
    }
}
