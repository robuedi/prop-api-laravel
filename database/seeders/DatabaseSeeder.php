<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\PropertyStatus;
use App\Models\Role;
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

        Role::insert([
            [
            'id' => 1,
            'name' => 'Tenant'
            ],
            [
            'id' => 2,
            'name' => 'Buyer'
            ],
            [
            'id' => 3,
            'name' => 'Landlord'
            ],
            [
            'id' => 4,
            'name' => 'Seller'
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

        // \App\Models\User::factory(10)->create();
    }
}
