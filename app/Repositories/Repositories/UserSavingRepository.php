<?php


namespace App\Repositories\Repositories;


use App\Models\Rent;
use App\Models\Saving;
use App\Repositories\UserRentRepositoryInterface;
use App\Repositories\UserSavingRepositoryInterface;

class UserSavingRepository implements UserSavingRepositoryInterface
{
    private Saving $user_saving;

    public function __construct(Saving $user_saving)
    {
        $this->user_saving = $user_saving;
    }

    public function create(int $user_id, float $amount) : Saving
    {
        return $this->user_saving
            ->create(['user_id' => $user_id, 'amount' => $amount]);
    }

    public function getFirstByUserId(int $user_id) : ?Saving
    {
        return $this->user_saving
            ->where(['user_id' => $user_id])
            ->first();
    }
}
