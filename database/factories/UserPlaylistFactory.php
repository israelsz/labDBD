<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Playlist;
use App\Models\Donation;

use App\Models\UserPlaylist;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPlaylistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPlaylist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_usuario' => User::all()->random()->id,
            'id_playlist' => Playlist::all()->random()->id,
            'id_donacion' => Donation::all()->random()->id,

        ];
    }
}
