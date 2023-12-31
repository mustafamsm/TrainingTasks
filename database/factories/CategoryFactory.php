<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
              'name_ar'=>$this->faker->name,
            'name_en'=>$this->faker->name,
            'image'=>$this->faker->image('public/storage/category-images', 400, 300, null, false),
            'status'=>$this->faker->boolean
        ];
    }
}
