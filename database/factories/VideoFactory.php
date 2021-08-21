<?php

namespace Database\Factories;

use App\Models\Commune;
use App\Models\User;
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
            'direccion_video' => $this->faker->randomElement($array = array ('https://www.youtube.com/watch?v=H8B-fo_Z2aI','https://www.youtube.com/watch?v=fFA1qsTEKus','https://www.youtube.com/watch?v=qBc6y4XG28s','https://www.youtube.com/watch?v=dQw4w9WgXcQ','https://www.youtube.com/watch?v=kJQP7kiw5Fk','https://www.youtube.com/watch?v=eY52Zsg-KVI', 'https://www.youtube.com/watch?v=KZi3bZYUWFg','https://www.youtube.com/watch?v=eps_zI-ZztA','https://www.youtube.com/watch?v=uaFB8P6b5Hg','https://www.youtube.com/watch?v=A2DFwUqFUQY','https://www.youtube.com/watch?v=_gxRuTLSPTo','https://www.youtube.com/watch?v=Wl959QnD3lM')),
            'titulo_video' => $this->faker->sentence(6,true),
            'visitas' => $this->faker->numberBetween(0,562395623),
            'restriccion_edad' => $this->faker->numberBetween(0,1),
            'popularidad' => $this->faker->randomFloat(2,0,1),
            'cantidad_temporadas' => $this->faker->numberBetween(0,15),
            'descripcion' => $this->faker->text(150),
            //Enlazar a id de otras tablas foraneas
            //Se enlaza al usuario
            'id_usuario_autor' => User::all()->random()->id,
            //Se enlaza a una comuna
            'id_comuna' => Commune::all()->random()->id
        ];
    }
}
