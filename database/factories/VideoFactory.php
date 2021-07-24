<?php

namespace Database\Factories;

use App\Models\Commune;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'direccion_video' => $this->faker->url(),
            'titulo_video' => $this->faker->sentence(6,true),
            'visitas' => $this->faker->numberBetween(0,562395623),
            'restriccion_edad' => $this->faker->numberBetween(0,1),
            'popularidad' => $this->faker->randomFloat(2,0,1),
            'cantidad_temporadas' => $this->faker->numberBetween(0,15),
            'descripcion' => $this->faker->text(150),
            //Enlazar a id de otras tablas foraneas
               //Falta enlazarlo a id usuario autor
            //Se enlaza a una comuna
            'id_comuna' => Commune::all()->random()->id
        ];
    }
}
