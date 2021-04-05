<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\PropertyStatus;
use App\Models\PropertyType;
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
            'name' => 'tenant'
            ],
            [
            'id' => 2,
            'name' => 'buyer'
            ],
            [
            'id' => 3,
            'name' => 'landlord'
            ],
            [
            'id' => 4,
            'name' => 'seller'
            ]
        ]);
        PropertyStatus::insert([
            [
            'id' => 1,
            'label' => 'active'
            ],
            [
            'id' => 2,
            'label' => 'inactive'
            ]
        ]);
        PropertyType::insert([
            [
            'id' => 1,
            'name' => 'rent'
            ],
            [
            'id' => 2,
            'label' => 'sell'
            ]
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
