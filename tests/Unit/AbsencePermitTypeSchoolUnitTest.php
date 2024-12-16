<?php

namespace Tests\Unit;

use App\Models\AbsencePermitType;
use App\Models\AbsencePermitTypeSchool;
use App\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AbsencePermitTypeSchoolUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_absence_permit_type_school_belongs_to_a_school()
    {
        $absencePermitTypeSchool = AbsencePermitTypeSchool::factory()->create();

        $this->assertInstanceOf(School::class, $absencePermitTypeSchool->school);
    }

    /** @test */
    public function an_absence_permit_type_school_belongs_to_an_absence_permit_type()
    {
        $absencePermitTypeSchool = AbsencePermitTypeSchool::factory()->create();

        $this->assertInstanceOf(AbsencePermitType::class, $absencePermitTypeSchool->absencePermitType);
    }
}
