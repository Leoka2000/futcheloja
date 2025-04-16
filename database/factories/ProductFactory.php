<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        // Generate multiple image URLs (e.g., 3 images)
        $imageUrls = [
            "products/Image 08-02-2025 at 03.45.jpg",
            "products/" . $this->faker->uuid . ".jpg",
        ];



        return [

            'name' => $this->faker->word,

            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'image' => json_encode($imageUrls, JSON_UNESCAPED_SLASHES),
        ];
    }
}
