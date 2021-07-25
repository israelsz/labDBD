<?php

namespace Database\Factories;

use App\Models\VideoCategory;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VideoCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_video'=>Video::all()->random()->id,
            'id_categoria'=>Category::all()->random()->id
        ];
    }
}
