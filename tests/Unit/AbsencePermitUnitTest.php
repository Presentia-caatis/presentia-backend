<?php

namespace Tests\Unit;

use App\Models\AbsencePermit;
use App\Models\AbsencePermitType;
use App\Models\Attendance;
use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AbsencePermitUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_absence_permit_belongs_to_an_attendance()
    {
        $absencePermit = AbsencePermit::factory()->create();

        $this->assertInstanceOf(Attendance::class, $absencePermit->attendance);
    }

    /** @test */
    public function an_absence_permit_belongs_to_an_absence_permit_type()
    {
        $absencePermit = AbsencePermit::factory()->create();

        $this->assertInstanceOf(AbsencePermitType::class, $absencePermit->absencePermitType);
    }

    /** @test */
    public function an_absence_permit_belongs_to_a_document_if_available()
    {
        $absencePermit = AbsencePermit::factory()->create(['document_id' => null]);

        $this->assertNull($absencePermit->document);
    }
}
