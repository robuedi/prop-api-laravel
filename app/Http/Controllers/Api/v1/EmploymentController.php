<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RoleUserEmploymentIndexRequest;
use App\Http\Requests\v1\RoleUserEmploymentStoreRequest;
use App\Http\Resources\v1\EmploymentResource;
use App\Models\RoleUser;
use Illuminate\Http\Response;

class EmploymentController extends Controller
{
    public function storeForUser(RoleUser $role_user, RoleUserEmploymentStoreRequest $request)
    {
        //make property for user
        return EmploymentResource::make(
            $role_user->employment->create(
                $request->get('job_title'),
                date('Y-m-d', strtotime($request->get('start_date'))),
                $request->has('end_date') ? date('Y-m-d', strtotime($request->get('end_date'))): null,
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function indexForUser(RoleUser $role_user, RoleUserEmploymentIndexRequest $request)
    {
        //make property for user
        return EmploymentResource::collection(
            $role_user->employment
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
