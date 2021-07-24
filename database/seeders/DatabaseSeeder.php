<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\Playlist;
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
        Category::factory(15)->create();
        PaymentMethod::factory(10)->create();
        Playlist::factory(15)->create();
    }

    
}
