<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl,
            'price' => $this->faker->randomFloat(1, 1, 100),
            'compare_price' => $this->faker->randomFloat(1, 1, 499),
            'options' => json_encode(['size' => ['S', 'M', 'L']]),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'is_featured' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['active', 'draft', 'archived']),
            'category_id' => Category::inRandomOrder()->first()->id,
            'store_id' => Store::inRandomOrder()->first()->id,

        ];
    }
}
