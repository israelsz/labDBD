<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Commune;
use App\Models\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->UserName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->password(), // password,
            'fecha_nacimiento'=>$this->faker->date(),
            'monedero'=>$this->faker->randomFloat(0,2,10000),
            'id_comuna' => Commune::all()->random()->id,
            'id_tipo_usuario' => UserType::all()->random()->id
                
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
