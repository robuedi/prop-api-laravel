<?php


namespace App\Repositories\Repositories;


use App\Models\UserRent;
use App\Repositories\UserRentRepositoryInterface;

class UserRentRepository implements UserRentRepositoryInterface
{
    private UserRent $user_rent;

    public function __construct(UserRent $user_rent)
    {
        $this->user_rent = $user_rent;
    }

    public function create(int $user_id, float $amount) : UserRent
    {
        return $this->user_rent
            ->create(['user_id' => $user_id, 'amount' => $amount]);
    }

    public function getFirstByUserId(int $user_id) : ?UserRent
    {
        return $this->user_rent
            ->where(['user_id' => $user_id])
            ->first();
    }
}
