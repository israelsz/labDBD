<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Region::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_region' => $this->faker->state(),
            'id_pais' => Country::all()->random()->id
        ];
    }
}
