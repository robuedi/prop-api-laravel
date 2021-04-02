<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserEmploymentShowRequest;
use App\Http\Requests\v1\UserEmploymentStoreRequest;
use App\Http\Resources\v1\UserEmploymentResource;
use App\Models\User;
use App\Repositories\UserEmploymentRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    private UserEmploymentRepositoryInterface $user_employment_repository;

    public function __construct(UserEmploymentRepositoryInterface $user_employment_repository)
    {
        $this->user_employment_repository = $user_employment_repository;
    }

    public function storeForUser(User $user,UserEmploymentStoreRequest $request)
    {
        //make property for user
        return UserEmploymentResource::make(
            $this->user_employment_repository->create(
                $user->id,
                $request->get('job_title'),
                $request->get('start_date'),
                $request->get('end_date')
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showForUser(User $user, UserEmploymentShowRequest $request)
    {
        //make property for user
        return UserEmploymentResource::make(
            $this->user_employment_repository->getFirstByUserId($user->id)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
