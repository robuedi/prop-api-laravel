<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\v1\AnnualSalaryStoreRequest;
use App\Http\Resources\v1\UserAnnualSalaryResource;
use App\Repositories\UserAnnualSalaryRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserAnnualSalariesController extends Controller
{
    private UserAnnualSalaryRepositoryInterface $user_annual_salary_repository;

    public function __construct(UserAnnualSalaryRepositoryInterface $user_annual_salary_repository)
    {
        $this->user_annual_salary_repository = $user_annual_salary_repository;
    }

    public function store(AnnualSalaryStoreRequest $request)
    {
        //make property for user
        return UserAnnualSalaryResource::make(
            $this->user_annual_salary_repository->create(auth()->user()->id, $request->get('amount'))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showCurrentUser()
    {
        //make property for user
        return UserAnnualSalaryResource::make(
            $this->user_annual_salary_repository->getFirstByUserId(auth()->user()->id)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
