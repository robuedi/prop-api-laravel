<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Resources\v1\UserEmploymentResource;
use App\Repositories\UserEmploymentRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserEmploymentController
{
    private UserEmploymentRepositoryInterface $user_employment_repository;

    public function __construct(UserEmploymentRepositoryInterface $user_employment_repository)
    {
        $this->user_employment_repository = $user_employment_repository;
    }

    public function store(Request $request)
    {
        //make property for user
        return UserEmploymentResource::make(
            $this->user_employment_repository->create(
                auth()->user()->id,
                $request->get('job_title'),
                $request->get('start_date'),
                $request->get('end_date')
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showCurrentUser()
    {
        //make property for user
        return UserEmploymentResource::make(
            $this->user_employment_repository->getFirstByUserId(auth()->user()->id)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
