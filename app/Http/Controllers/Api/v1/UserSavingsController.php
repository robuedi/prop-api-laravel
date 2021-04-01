<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserSavingResource;
use App\Repositories\UserSavingRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserSavingsController extends Controller
{
    private UserSavingRepositoryInterface $user_saving_repository;

    public function __construct(UserSavingRepositoryInterface $user_saving_repository)
    {
        $this->user_saving_repository = $user_saving_repository;
    }

    public function store(Request $request)
    {
        //make property for user
        return UserSavingResource::make(
            $this->user_saving_repository->create(auth()->user()->id, $request->get('amount'))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showCurrentUser()
    {
        //make property for user
        return UserSavingResource::make(
            $this->user_saving_repository->getFirstByUserId(auth()->user()->id)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
