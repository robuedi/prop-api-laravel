<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserRentResource;
use App\Repositories\UserRentRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserRentsController extends Controller
{
    private UserRentRepositoryInterface $user_rent_repository;

    public function __construct(UserRentRepositoryInterface $user_rent_repository)
    {
        $this->user_rent_repository = $user_rent_repository;
    }

    public function store(Request $request)
    {
        //make property for user
        return UserRentResource::make(
            $this->user_rent_repository->create(auth()->user()->id, $request->get('amount'))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showCurrentUser()
    {
        //make property for user
        return UserRentResource::make(
            $this->user_rent_repository->getFirstByUserId(auth()->user()->id)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
