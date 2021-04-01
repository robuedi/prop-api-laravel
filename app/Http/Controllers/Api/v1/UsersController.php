<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Api\ApiResponse;
use App\Http\Services\UserProfileStatus\UserProfileStatusServiceInterface;
use Illuminate\Http\Response;

class UsersController
{
    use ApiResponse;

    private UserProfileStatusServiceInterface $user_profile_status;

    public function __construct(UserProfileStatusServiceInterface $user_profile_status)
    {
        $this->user_profile_status = $user_profile_status;
    }

    public function checkUserProfileComplete()
    {
        return $this->apiResponse([
            'status' => $this->user_profile_status->checkUserProfileCompleted(auth()->user()->id)
        ], Response::HTTP_OK);
    }

}
