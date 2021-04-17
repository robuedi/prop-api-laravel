<?php


namespace App\Http\Controllers\Api\v1\Properties;

use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralResource;
use App\Models\RoleUser;
use Illuminate\Http\Response;

class PropertiesApplicationsController extends Controller
{
    public function index(RoleUser $role_user, Request $request)
    {
        return GeneralResource::collection($role_user->propertyApplications)->response()->setStatusCode(Response::HTTP_OK);
    }
}
