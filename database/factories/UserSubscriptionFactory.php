<?php

namespace Database\Factories;

use App\Models\UserSubscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserSubscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_usuario_suscripcion' => User::all()->random()->id,
            'id_usuario_suscriptor' => User::all()->random()->id,
        ];
    }
}
