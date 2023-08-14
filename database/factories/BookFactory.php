<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
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
            'author'=>$this->faker->name,
            'publication' => $this->faker->date(),
            'category_id' => Category::all()->random()->id,
            'image'=>$this->faker->image('public/storage/book-images', 400, 300, null, false),
            'description_ar' => $this->faker->text,
            'description_en' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
