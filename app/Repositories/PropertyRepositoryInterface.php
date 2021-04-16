<?php

namespace App\Repositories;

interface PropertyRepositoryInterface
{
    public function createWithOptionalAddress(array $property_data, ?array $address_data);
}
