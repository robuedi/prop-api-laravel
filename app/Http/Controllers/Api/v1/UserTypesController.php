<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\v1\UserTypeResource;
use App\Repositories\UserTypeRepositoryInterface;
use Illuminate\Http\Response;

class UserTypesController
{
    private UserTypeRepositoryInterface $user_type_repository;

    public function __construct(UserTypeRepositoryInterface $user_type_repository)
    {
        $this->user_type_repository = $user_type_repository;
    }

    public function index()
    {
        return UserTypeResource::collection($this->user_type_repository->index())->response()->setStatusCode(Response::HTTP_OK);
    }
}
