<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    //  public function run()
    // {
    //     \App\Models\Feature::factory(10)->create();
    //     \App\Models\SubscriptionPlan::factory(5)->create();
    //     \App\Models\School::factory(20)->create();
    //     \App\Models\SubscriptionFeature::factory(30)->create();
    //     \App\Models\SchoolFeature::factory(30)->create();
    //     \App\Models\SubscriptionHistory::factory(50)->create();
    //     \App\Models\Payment::factory(50)->create();
    //     \App\Models\ClassGroup::factory(10)->create();
    //     \App\Models\Student::factory(100)->create();
    //     \App\Models\AttendanceLateType::factory(3)->create();
    //     \App\Models\Attendance::factory(200)->create();
    //     \App\Models\Document::factory(20)->create();
    //     \App\Models\AbsencePermitType::factory(5)->create();
    //     \App\Models\AbsencePermit::factory(50)->create();
    // }

    public function run(){


        \App\Models\SubscriptionPlan::factory()->create([
            'subscription_name' => 'Basic',
            'billing_cycle_month' => 1,
            'price' => 0,
        ]); 

        \App\Models\School::factory()->create([
            'subscription_plan_id' => 1,
            'logo_image_path' => 'images/Logo-SMK-10-Bandung.png', 
            'school_name' => 'SMKN 10 Bandung',
            'address' => 'Jl. Kebon Jeruk No. 1, Jakarta',
            'latest_subscription' => now(),
            'end_subscription' => now()->addMonth(),
        ]);


        \App\Models\User::factory()->create([
            'school_id' => 1,
            'email' => 'presentia@gmail.com',
            'fullname' => 'Presentia Official Account',
            'username' => 'presentia',
            'password' => bcrypt('12345678')
        ]);

        \App\Models\AttendanceSchedule::factory()->create([
            'event_id' => null,
            'type' => 'default',
            'name' => 'Default Schedule',
            'check_in_start_time' => now()->setTime(7,0),
            'check_in_end_time' => now()->setTime(8,0),
            'check_out_start_time' => now()->setTime(16,0),
            'check_out_end_time' =>now()->setTime(15,0),
        ]);

        \App\Models\AttendanceSchedule::factory()->create([
            'event_id' => null,
            'type' => 'holiday',
            'name' => 'Default Schedule',
        ]);


        \App\Models\Day::factory()->create([
            'attendance_schedule_id' => 1,
            'school_id' => 1,
            'name' => 'monday',
        ]);

        \App\Models\Day::factory()->create([
            'attendance_schedule_id' => 1,
            'school_id' => 1,
            'name' => 'tuesday',
        ]);

        \App\Models\Day::factory()->create([
            'attendance_schedule_id' => 1,
            'school_id' => 1,
            'name' => 'wednesday',
        ]);

        \App\Models\Day::factory()->create([
            'attendance_schedule_id' => 1,
            'school_id' => 1,
            'name' => 'thursday',
        ]);

        \App\Models\Day::factory()->create([
            'attendance_schedule_id' => 1,
            'school_id' => 1,
            'name' => 'friday',
        ]);

        \App\Models\Day::factory()->create([
            'attendance_schedule_id' => 2,
            'school_id' => 1,
            'name' => 'saturday',
        ]);

        \App\Models\Day::factory()->create([
            'attendance_schedule_id' => 2,
            'school_id' => 1,
            'name' => 'sunday',
        ]);

        \App\Models\Student::factory(3)->create([
            'school_id' => 1,
        ]);

        

        \App\Models\AttendanceLateType::factory()->create([
            'type_name' => 'Late',
            'description' => 'Late',
            'late_duration' => '15',
            'is_active' => true,
            'school_id' => 1,
        ]);

        \App\Models\AttendanceLateType::factory()->create([
            'type_name' => 'On Time',
            'description' => 'On Time',
            'late_duration' => '0',
            'is_active' => true,
            'school_id' => 1,
        ]);

        \App\Models\AttendanceWindow::factory()->create([
            'day_id' => 4,
            'name' => 'Default Schedule 16-01-2025',
            'total_present' => 0,
            'total_absent' => 0,
            'date' => '2025-01-16',
            'type' => 'default',
            'check_in_start_time' => '2025-01-16 07:00:00',
            'check_in_end_time' => '2025-01-16 08:00:00',
            'check_out_start_time' => '2025-01-16 16:00:00',
            'check_out_end_time' => '2025-01-16 15:00:00',
        ]);
    }
}
