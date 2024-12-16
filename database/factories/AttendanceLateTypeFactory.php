<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttendanceLateType>
 */
class AttendanceLateTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type_name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'active_status' => $this->faker->boolean,
        ];
    }
}
