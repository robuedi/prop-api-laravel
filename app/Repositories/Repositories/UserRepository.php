<?php


namespace App\Repositories\Repositories;


use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserTypeById(int $user_id) : ?int
    {
        $user = $this->user->find($user_id);
        if(!$user)
        {
            return null;
        }

        return $user->type_id;
    }

    public function makeUserProfileCompleted(int $user_id)
    {
        $this->user->where('id', $user_id)->update(['is_completed' => 1]);
    }

}
