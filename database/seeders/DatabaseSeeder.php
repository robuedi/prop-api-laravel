<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
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
        UserType::create([
            'id' => 1,
            'label' => 'Tenant'
        ]);
        UserType::create([
            'id' => 2,
            'label' => 'Buyer'
        ]);
        UserType::create([
            'id' => 3,
            'label' => 'Landlord'
        ]);
        UserType::create([
            'id' => 4,
            'label' => 'Seller'
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
