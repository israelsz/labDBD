<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\Video;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feedback::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'tipo_valoracion' => $this->faker->numberBetween(0,1),
            //Se enlaza a un usuario
            'id_usuario' => User::all()->random()->id,
            //Se enlaza a un video
            'id_video' => Video::all()->random()->id,
        ];
    }
}
