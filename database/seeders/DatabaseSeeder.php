<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\PropertyStatus;
use App\Models\UserPropertyType;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Country::factory(10)->create();
        City::factory(100)->create();

        UserType::insert([
            [
            'id' => 1,
            'label' => 'Tenant'
            ],
            [
            'id' => 2,
            'label' => 'Buyer'
            ],
            [
            'id' => 3,
            'label' => 'Landlord'
            ],
            [
            'id' => 4,
            'label' => 'Seller'
            ]
        ]);
        PropertyStatus::insert([
            [
            'id' => 1,
            'label' => 'Active'
            ],
            [
            'id' => 2,
            'label' => 'Inactive'
            ]
        ]);
        PropertyType::insert([
            [
                'id' => 1,
                'label' => 'rent'
            ],
            [
                'id' => 2,
                'label' => 'sell'
            ]
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
