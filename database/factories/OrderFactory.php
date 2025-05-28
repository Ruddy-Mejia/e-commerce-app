<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'created_at' => Carbon::now()->subMonths(rand(0, 11)),
            'items' => json_encode([
                ["id" => 26, "price" => 0.99, "title" => "Green Chili Pepper", "quantity" => 1, "thumbnail" => "https://cdn.dummyjson.com/product-images/groceries/green-chili-pepper/thumbnail.webp"],
                ["id" => 31, "price" => 0.79, "title" => "Lemon", "quantity" => 1, "thumbnail" => "https://cdn.dummyjson.com/product-images/groceries/lemon/thumbnail.webp"],
            ]),
            'total_price' => rand(100, 1000),
        ];
    }
}
