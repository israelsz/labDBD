<?php

namespace Database\Factories;

use App\Models\UserVideo;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserVideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserVideo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_usuario' => User::all()->random()->id,
            'id_video' => Video::all()->random()->id,
        ];
    }
}
