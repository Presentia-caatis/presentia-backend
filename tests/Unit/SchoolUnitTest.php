<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\School;
use App\Models\SchoolFeature;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionHistory;
use App\Models\Payment;
use App\Models\AbsencePermitType;
use App\Models\AttendanceLateType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fill_mass_assignable_fields()
    {
        $subscriptionPlan = SubscriptionPlan::factory()->create();

        $data = [
            'subscription_plan_id' => $subscriptionPlan->id,
            'school_name' => 'Test School',
            'latest_subscription' => now()->toDateString(),
            'end_subscription' => now()->addMonth()->toDateString(),
        ];

        $school = School::create($data);

        $this->assertDatabaseHas('schools', $data);
        $this->assertEquals($data['school_name'], $school->school_name);
    }

    /** @test */
    public function it_has_a_relationship_with_subscription_plan()
    {
        $subscriptionPlan = SubscriptionPlan::factory()->create();
        $school = School::factory()->create(['subscription_plan_id' => $subscriptionPlan->id]);

        $this->assertInstanceOf(SubscriptionPlan::class, $school->subscriptionPlan);
        $this->assertEquals($subscriptionPlan->id, $school->subscriptionPlan->id);
    }

    /** @test */
    public function it_has_a_relationship_with_school_features()
    {
        $school = School::factory()->create();
        $schoolFeatures = SchoolFeature::factory()->count(3)->create(['school_id' => $school->id]);

        $this->assertCount(3, $school->schoolFeatures);
        $this->assertInstanceOf(SchoolFeature::class, $school->schoolFeatures->first());
    }

    /** @test */
    public function it_has_a_relationship_with_subscription_histories()
    {
        $school = School::factory()->create();
        $subscriptionHistories = SubscriptionHistory::factory()->count(2)->create(['school_id' => $school->id]);

        $this->assertCount(2, $school->subscriptionHistories);
        $this->assertInstanceOf(SubscriptionHistory::class, $school->subscriptionHistories->first());
    }

    /** @test */
    public function it_has_a_relationship_with_payments()
    {
        $school = School::factory()->create();
        $payments = Payment::factory()->count(4)->create(['school_id' => $school->id]);

        $this->assertCount(4, $school->payments);
        $this->assertInstanceOf(Payment::class, $school->payments->first());
    }

    /** @test */
    public function it_has_a_relationship_with_absence_permit_types()
    {
        $school = School::factory()->create();
        $absencePermitTypes = AbsencePermitType::factory()->count(2)->create();

        $school->absencePermitTypes()->attach($absencePermitTypes);

        $this->assertCount(2, $school->absencePermitTypes);
        $this->assertInstanceOf(AbsencePermitType::class, $school->absencePermitTypes->first());
    }

    /** @test */
    public function it_has_a_relationship_with_attendance_late_types()
    {
        $school = School::factory()->create();
        $attendanceLateTypes = AttendanceLateType::factory()->count(3)->create();

        $school->attendanceLateTypes()->attach($attendanceLateTypes);

        $this->assertCount(3, $school->attendanceLateTypes);
        $this->assertInstanceOf(AttendanceLateType::class, $school->attendanceLateTypes->first());
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        $subscriptionPlan = SubscriptionPlan::factory()->create();

        School::create([
            'subscription_plan_id' => $subscriptionPlan->id,
            'school_name' => null,
        ]);
    }

    /** @test */
    public function it_fails_when_subscription_plan_id_is_null()
    {
        $data = [
            'subscription_plan_id' => null, // Null value for a NOT NULL column
            'school_name' => 'Nullable Plan School',
            'latest_subscription' => now()->toDateString(),
            'end_subscription' => now()->addMonth()->toDateString(),
        ];

        $this->expectException(\Illuminate\Database\QueryException::class);
        $this->expectExceptionMessage("Column 'subscription_plan_id' cannot be null");

        // Attempt to create a school with a null subscription_plan_id
        School::create($data);

        // Ensure no record is created in the database
        $this->assertDatabaseMissing('schools', ['school_name' => 'Nullable Plan School']);
    }

    /** @test */
    public function it_checks_date_fields_format()
    {
        $school = School::factory()->create([
            'latest_subscription' => '2024-10-01',
            'end_subscription' => '2024-12-01',
        ]);

        $this->assertEquals('2024-10-01', $school->latest_subscription);
        $this->assertEquals('2024-12-01', $school->end_subscription);
    }

    /** @test */
    public function it_checks_relationship_cascade_delete()
    {
        $school = School::factory()->create();
        $schoolFeature = SchoolFeature::factory()->create(['school_id' => $school->id]);

        $school->delete();

        $this->assertDatabaseMissing('schools', ['id' => $school->id]);
        $this->assertDatabaseMissing('school_features', ['id' => $schoolFeature->id]);
    }
}
