<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserAddressShowRequest;
use App\Http\Requests\v1\UserAddressStoreRequest;
use App\Http\Resources\v1\UserAddressResource;
use App\Models\User;
use App\Repositories\UserAddressRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserAddressController extends Controller
{
    private UserAddressRepositoryInterface $user_address_repository;

    public function __construct(UserAddressRepositoryInterface $user_address_repository)
    {
        $this->user_address_repository = $user_address_repository;
    }

    public function storeForUser(User $user, UserAddressStoreRequest $request)
    {
        //make property for user
        return UserAddressResource::make(
            $this->user_address_repository->create(
                $user->id,
                $request->get('city_id'),
                $request->get('address_line'),
                $request->get('postcode')
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showForUser(User $user, UserAddressShowRequest $request)
    {
        //make property for user
        return UserAddressResource::make(
            $this->user_address_repository->getFirstByUserId($user->id)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
