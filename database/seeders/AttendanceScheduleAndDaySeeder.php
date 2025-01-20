<?php

namespace Database\Seeders;

use App\Models\AttendanceSchedule;
use App\Models\Day;
use Illuminate\Database\Seeder;

class AttendanceScheduleAndDaySeeder extends Seeder
{
    private $school_id;

    public function __construct($school_id)
    {
        $this->school_id = $school_id;
    }
    
    public function run(): void
    {
        $defaultAttendanceSchedule = AttendanceSchedule::create([
            'event_id' => null,
            'type' => 'default',
            'name' => 'Default Schedule',
            'check_in_start_time' => now()->setTime(7,0),
            'check_in_end_time' => now()->setTime(8,0),
            'check_out_start_time' => now()->setTime(16,0),
            'check_out_end_time' => now()->setTime(15,0),
        ]);

        $holidayAttendanceSchedule = AttendanceSchedule::create([
            'event_id' => null,
            'type' => 'holiday',
            'name' => 'Default Schedule',
        ]);

        $weekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        foreach ($weekdays as $day) {
            Day::create([
                'attendance_schedule_id' => $defaultAttendanceSchedule->id,
                'school_id' => $this->school_id,
                'name' => $day,
            ]);
        }

        $weekends = ['saturday', 'sunday'];
        foreach ($weekends as $day) {
            Day::create([
                'attendance_schedule_id' => $holidayAttendanceSchedule->id,
                'school_id' => $this->school_id,
                'name' => $day,
            ]);
        }
    }
}
