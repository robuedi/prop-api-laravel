<?php

namespace App\Repositories;

use App\Models\AgencyAddress;

interface AgencyAddressRepositoryInterface
{
    public function getFirstByAgencyId(int $agency_id): ?AgencyAddress;
}
