<?php

namespace Database\Factories;

use App\Models\Api\V1\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => 'images/' . $this->faker->image('public/storage/images', 640, 480, null, false)
        ];
    }
}
