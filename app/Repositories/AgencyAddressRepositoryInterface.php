<?php

namespace App\Repositories;

use App\Models\AgencyAddress;

interface AgencyAddressRepositoryInterface
{
    public function create(int $agency_id, int $city_id, string $address_line, string $postcode): AgencyAddress;

    public function getFirstByAgencyId(int $agency_id): ?AgencyAddress;
}
