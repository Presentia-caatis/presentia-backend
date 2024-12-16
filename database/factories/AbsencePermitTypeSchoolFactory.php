<?php

namespace Database\Factories;

use App\Models\AbsencePermitType;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AbsencePermitTypeSchool>
 */
class AbsencePermitTypeSchoolFactory extends Factory
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
            'absence_permit_type_id' => AbsencePermitType::factory(), 
        ];
    }
}
