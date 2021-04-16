<?php


namespace App\Repositories\Repositories;


use App\Models\Rent;
use App\Repositories\UserRentRepositoryInterface;

class UserRentRepository implements UserRentRepositoryInterface
{
    private Rent $user_rent;

    public function __construct(Rent $user_rent)
    {
        $this->user_rent = $user_rent;
    }

    public function create(int $user_id, float $amount) : Rent
    {
        return $this->user_rent
            ->create(['user_id' => $user_id, 'amount' => $amount]);
    }

    public function getFirstByUserId(int $user_id) : ?Rent
    {
        return $this->user_rent
            ->where(['user_id' => $user_id])
            ->first();
    }
}
