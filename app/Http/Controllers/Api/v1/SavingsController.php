<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserSavingsShowRequest;
use App\Http\Requests\v1\UserSavingsStoreRequest;
use App\Http\Resources\v1\UserSavingResource;
use App\Models\User;
use App\Repositories\UserSavingRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SavingsController extends Controller
{
    private UserSavingRepositoryInterface $user_saving_repository;

    public function __construct(UserSavingRepositoryInterface $user_saving_repository)
    {
        $this->user_saving_repository = $user_saving_repository;
    }

    public function storeForUser(User $user, UserSavingsStoreRequest $request)
    {
        //make property for user
        return UserSavingResource::make(
            $this->user_saving_repository->create($user->id, $request->get('amount'))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showForUser(User $user, UserSavingsShowRequest $request)
    {
        //make property for user
        return UserSavingResource::collection(
            $user->savings
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
