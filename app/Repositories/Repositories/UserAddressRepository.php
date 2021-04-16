<?php


namespace App\Repositories\Repositories;


use App\Models\RoleUserAddress;
use App\Repositories\UserAddressRepositoryInterface;

class UserAddressRepository implements UserAddressRepositoryInterface
{
    private RoleUserAddress $user_address;

    public function __construct(RoleUserAddress $user_address)
    {
        $this->user_address = $user_address;
    }

    public function create(int $user_id, int $city_id, string $address_line, string $postcode) : RoleUserAddress
    {
        return $this->user_address
            ->create([
                'user_id' => $user_id,
                'city_id' => $city_id,
                'address_line' => $address_line,
                'postcode' => $postcode
            ]);
    }

    public function getFirstByUserId(int $user_id) : ?RoleUserAddress
    {
        return $this->user_address
            ->where(['user_id' => $user_id])
            ->first();
    }
}
