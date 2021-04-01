<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserAddressResource;
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

    public function store(Request $request)
    {
        //make property for user
        return UserAddressResource::make(
            $this->user_address_repository->create(
                auth()->user()->id,
                $request->get('city_id'),
                $request->get('address_line'),
                $request->get('postcode')
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function showCurrentUser()
    {
        //make property for user
        return UserAddressResource::make(
            $this->user_address_repository->getFirstByUserId(auth()->user()->id)
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
