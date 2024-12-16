<?php

namespace Tests\Unit;

use App\Models\AttendanceLateType;
use App\Models\AttendanceLateTypeSchool;
use App\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceLateTypeSchoolUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_attendance_late_type_school_belongs_to_a_school()
    {
        $lateTypeSchool = AttendanceLateTypeSchool::factory()->create();

        $this->assertInstanceOf(School::class, $lateTypeSchool->school);
    }

    /** @test */
    public function an_attendance_late_type_school_belongs_to_an_attendance_late_type()
    {
        $lateTypeSchool = AttendanceLateTypeSchool::factory()->create();

        $this->assertInstanceOf(AttendanceLateType::class, $lateTypeSchool->attendanceLateType);
    }

    /** @test */
    public function it_can_create_an_attendance_late_type_school_record()
    {
        $school = School::factory()->create();
        $lateType = AttendanceLateType::factory()->create();

        $lateTypeSchool = AttendanceLateTypeSchool::create([
            'school_id' => $school->id,
            'attendance_late_type_id' => $lateType->id,
        ]);

        $this->assertDatabaseHas('attendance_late_type_schools', [
            'id' => $lateTypeSchool->id,
            'school_id' => $school->id,
            'attendance_late_type_id' => $lateType->id,
        ]);
    }
}
