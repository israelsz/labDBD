<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\PaymentMethod;
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
        PaymentMethod::factory(10)->create();
    }
}
