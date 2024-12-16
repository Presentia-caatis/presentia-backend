<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionPlan>
 */
class SubscriptionPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subscription_name' => $this->faker->word,
            'billing_cycle' => $this->faker->randomElement(['monthly', 'yearly']), 
            'price' => $this->faker->numberBetween(10, 100),
        ];
    }
}
