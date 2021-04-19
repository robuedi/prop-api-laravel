<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RoleUserEmploymentStoreRequest;
use App\Http\Resources\v1\EmploymentResource;
use App\Models\RoleUser;
use Illuminate\Http\Response;

class EmploymentController extends Controller
{
    public function index(RoleUser $role_user)
    {
        //make property for user
        return EmploymentResource::collection(
            $role_user->employment
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function store(RoleUser $role_user, RoleUserEmploymentStoreRequest $request)
    {
        //make property for user
        return EmploymentResource::make(
            $role_user->employment()->create([
                'job_title' => $request->get('job_title'),
                'start_date' => date('Y-m-d', strtotime($request->get('start_date'))),
                'end_date' => $request->has('end_date') ? date('Y-m-d', strtotime($request->get('end_date'))): null,
        ]))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
