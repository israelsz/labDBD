<?php

namespace Database\Factories;

use App\Models\PlaylistVideo;
use App\Models\Video;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaylistVideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlaylistVideo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            //Se enlaza a un video
            'id_video' => Video::all()->random()->id,
            //Se enlaza a una playlist
            'id_playlist' => Playlist::all()->random()->id,
            

        ];
    }
}
