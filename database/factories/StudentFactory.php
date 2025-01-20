<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'school_id' => \App\Models\School::factory(),
            'class_group_id' => \App\Models\ClassGroup::inRandomOrder()
                ->first()->id,
            'is_active' => true,
            'nis' => $this->faker->unique()->numerify('NIS####'),
            'nisn' => $this->faker->unique()->numerify('NISN####'),
            'student_name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['male', 'female']),
        ];
    }
}
