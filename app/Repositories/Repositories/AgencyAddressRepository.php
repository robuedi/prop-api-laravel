<?php


namespace App\Repositories\Repositories;


use App\Models\AgencyAddress;
use App\Repositories\AgencyAddressRepositoryInterface;

class AgencyAddressRepository implements AgencyAddressRepositoryInterface
{
    private AgencyAddress $agency_address;

    public function __construct(AgencyAddress $agency_address)
    {
        $this->agency_address = $agency_address;
    }

    public function create(int $agency_id, int $city_id, string $address_line, string $postcode) : AgencyAddress
    {
        return $this->agency_address
            ->create([
                'agency_id' => $agency_id,
                'city_id' => $city_id,
                'address_line' => $address_line,
                'postcode' => $postcode
            ]);
    }

    public function getFirstByAgencyId(int $agency_id) : ?AgencyAddress
    {
        return $this->agency_address
            ->where(['agency_id' => $agency_id])
            ->first();
    }
}
