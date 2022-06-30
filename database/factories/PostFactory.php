<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'title' =>$this->faker->sentence(rand(5,10),true),
            'content' =>$this->faker->paragraph(rand(1,3),true),
            'image' => 'http://via.placeholder.com/640x360'
        ];
    }
}
