<?php


namespace App\Repositories\Repositories;


use App\Models\UserAddress;
use App\Repositories\UserAddressRepositoryInterface;

class UserAddressRepository implements UserAddressRepositoryInterface
{
    private UserAddress $user_address;

    public function __construct(UserAddress $user_address)
    {
        $this->user_address = $user_address;
    }

    public function create(int $user_id, int $city_id, string $address_line, string $postcode) : UserAddress
    {
        return $this->user_address
            ->create([
                'user_id' => $user_id,
                'city_id' => $city_id,
                'address_line' => $address_line,
                'postcode' => $postcode
            ]);
    }

    public function getFirstByUserId(int $user_id) : ?UserAddress
    {
        return $this->user_address
            ->where(['user_id' => $user_id])
            ->first();
    }
}
