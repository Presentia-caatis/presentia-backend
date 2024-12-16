<?php

namespace Database\Factories;

use App\Models\AttendanceLateType;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttendanceLateTypeSchool>
 */
class AttendanceLateTypeSchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'school_id' => School::factory(), 
            'attendance_late_type_id' => AttendanceLateType::factory(),
        ];
    }
}
