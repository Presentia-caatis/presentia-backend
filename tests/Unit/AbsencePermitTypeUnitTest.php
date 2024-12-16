<?php

namespace Tests\Unit;

use App\Models\AbsencePermit;
use App\Models\AbsencePermitType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AbsencePermitTypeUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_absence_permit_type_has_many_absence_permits()
    {
        $absencePermitType = AbsencePermitType::factory()->create();

        AbsencePermit::factory(3)->create(['absence_permit_type_id' => $absencePermitType->id]);

        $this->assertCount(3, $absencePermitType->absencePermits);
    }
}
