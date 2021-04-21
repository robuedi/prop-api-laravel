<?php

namespace App\Http\Controllers\Api\v1\Properties;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;

class PropertiesController extends Controller
{
    public function index()
    {
        $properties = QueryBuilder::for(Property::class)
                ->allowedFields([
                    'id', 'name', 'slug', 'created_at',
                    'address.id', 'address.city_id', 'address.property_id', 'address.postcode', 'address.address_line',
                    'address.city.id', 'address.city.country_id', 'address.city.name',
                    'address.city.country.id', 'address.city.country.name',
                    'images.id', 'images.path',
                ])
                ->allowedIncludes(['address', 'address.city', 'address.city.country', 'images'])
                ->get();

        return PropertyResource::collection($properties)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function show(String $property_slug)
    {
        $_property = QueryBuilder::for(Property::where('slug', $property_slug))
            ->allowedFields([
                'id', 'name', 'slug', 'type_id', 'created_at',
                'address.id', 'address.city_id', 'address.property_id', 'address.postcode', 'address.address_line',
                'address.city.id', 'address.city.country_id', 'address.city.name',
                'address.city.country.id', 'address.city.country.name',
                'images.path',
            ])
            ->allowedIncludes(['address', 'address.city', 'address.city.country', 'images'])
            ->first();

        return PropertyResource::make($_property)->response()->setStatusCode(Response::HTTP_OK);
    }
}
