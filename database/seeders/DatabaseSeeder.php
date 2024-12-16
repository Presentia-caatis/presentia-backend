<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

     public function run()
    {
        \App\Models\Feature::factory(10)->create();
        \App\Models\SubscriptionPlan::factory(5)->create();
        \App\Models\School::factory(20)->create();
        \App\Models\SubscriptionFeature::factory(30)->create();
        \App\Models\SchoolFeature::factory(30)->create();
        \App\Models\SubscriptionHistory::factory(50)->create();
        \App\Models\Payment::factory(50)->create();
        \App\Models\ClassGroup::factory(10)->create();
        \App\Models\Student::factory(100)->create();
        \App\Models\AttendanceLateType::factory(3)->create();
        \App\Models\Attendance::factory(200)->create();
        \App\Models\Document::factory(20)->create();
        \App\Models\AbsencePermitType::factory(5)->create();
        \App\Models\AbsencePermit::factory(50)->create();
        \App\Models\AbsencePermitTypeSchool::factory(3)->create();
        \App\Models\AttendanceLateTypeSchool::factory(3)->create();
    }
}
