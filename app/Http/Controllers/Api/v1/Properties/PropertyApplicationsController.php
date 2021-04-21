<?php


namespace App\Http\Controllers\Api\v1\Properties;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RoleUserPropertyApplicationStoreRequest;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\v1\PropertyResource;
use App\Models\Property;
use App\Models\RoleUser;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class PropertyApplicationsController extends Controller
{
    public function index(RoleUser $role_user)
    {
        $applied_properties = QueryBuilder::for($role_user->appliedProperties()->getQuery())
            ->allowedFields([
                'id', 'name', 'slug', 'created_at',
                'address.id', 'address.city_id', 'address.property_id', 'address.postcode', 'address.address_line',
                'address.city.id', 'address.city.country_id', 'address.city.name',
                'address.city.country.id', 'address.city.country.name',
                'images.id', 'images.path',
            ])
            ->allowedIncludes(['address', 'address.city', 'address.city.country', 'images'])
            ->get();

        return PropertyResource::collection($applied_properties)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function store(RoleUser $role_user, RoleUserPropertyApplicationStoreRequest $request)
    {
        //make property for user
        return GeneralResource::make(
            $role_user->propertiesApplications()->create($request->only(['property_id']))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
