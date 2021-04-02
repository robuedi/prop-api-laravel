<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserAnnualSalaryShowRequest;
use App\Http\Requests\v1\UserAnnualSalaryStoreRequest;
use App\Http\Resources\v1\UserAnnualSalaryResource;
use App\Models\User;
use App\Repositories\UserAnnualSalaryRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class AnnualSalariesController extends Controller
{
    private UserAnnualSalaryRepositoryInterface $user_annual_salary_repository;

    public function __construct(UserAnnualSalaryRepositoryInterface $user_annual_salary_repository)
    {
        $this->user_annual_salary_repository = $user_annual_salary_repository;
    }

    public function storeForUser(User $user,UserAnnualSalaryStoreRequest $request)
    {
        //make property for user
        return UserAnnualSalaryResource::make(
            $this->user_annual_salary_repository->create($user->id, $request->get('amount'))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showForUser(User $user, UserAnnualSalaryShowRequest $request)
    {
        //make property for user
        return UserAnnualSalaryResource::make(
            $this->user_annual_salary_repository->getFirstByUserId($user->id)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
