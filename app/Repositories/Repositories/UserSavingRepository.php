<?php


namespace App\Repositories\Repositories;


use App\Models\UserRent;
use App\Models\UserSaving;
use App\Repositories\UserRentRepositoryInterface;
use App\Repositories\UserSavingRepositoryInterface;

class UserSavingRepository implements UserSavingRepositoryInterface
{
    private UserSaving $user_saving;

    public function __construct(UserSaving $user_saving)
    {
        $this->user_saving = $user_saving;
    }

    public function create(int $user_id, float $amount) : UserSaving
    {
        return $this->user_saving
            ->create(['user_id' => $user_id, 'amount' => $amount]);
    }

    public function getFirstByUserId(int $user_id) : ?UserSaving
    {
        return $this->user_saving
            ->where(['user_id' => $user_id])
            ->first();
    }
}
