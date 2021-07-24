<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\Video;
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
            'tipo_valoracion' => $this->faker->boolean(70),
            //Enlazar a id de otras tablas foraneas
               //Falta enlazarlo a id autor
            //Se enlaza a un video
            'id_video' => Video::all()->random()->id,
        ];
    }
}
