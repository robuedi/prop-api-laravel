<?php


namespace App\Http\Controllers\Api\v1\Properties;

use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralResource;
use App\Models\RoleUser;
use Illuminate\Http\Response;

class PropertyApplicationsController extends Controller
{
    public function index(RoleUser $role_user)
    {
        return GeneralResource::collection($role_user->propertyApplications)->response()->setStatusCode(Response::HTTP_OK);
    }
}
