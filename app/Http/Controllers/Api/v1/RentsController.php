<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserRentShowRequest;
use App\Http\Requests\v1\UserRentStoreRequest;
use App\Http\Resources\v1\UserRentResource;
use App\Models\User;
use App\Repositories\UserRentRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class RentsController extends Controller
{
    private UserRentRepositoryInterface $user_rent_repository;

    public function __construct(UserRentRepositoryInterface $user_rent_repository)
    {
        $this->user_rent_repository = $user_rent_repository;
    }

    public function storeForUser(User $user, UserRentStoreRequest $request)
    {
        //make property for user
        return UserRentResource::make(
            $this->user_rent_repository->create($user->id, $request->get('amount'))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showForUser(User $user, UserRentShowRequest $request)
    {
        //make property for user
        return UserRentResource::make(
            $this->user_rent_repository->getFirstByUserId($user->id)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
