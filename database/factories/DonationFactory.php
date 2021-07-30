<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\Video;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'monto'=>$this->faker->randomfloat(2,0,10000),
            'fecha_donacion'=>$this->faker->date(),
            'id_donador'=>User::all()->random()->id,
            'id_receptor'=>User::all()->random()->id,
            'id_metodo_pago'=>PaymentMethod::all()->random()->id,
            'id_playlist'=>Playlist::all()->random()->id,
            'id_video'=>Video::all()->random()->id
            //
        ];
    }
}
