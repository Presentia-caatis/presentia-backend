<?php

namespace Database\Seeders;

use App\Models\AttendanceWindow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceWindowSeeder extends Seeder
{
    private $school_id;

    public function __construct($school_id)
    {
        $this->school_id = $school_id;
    }

    public function run()
    {
        $currentDate = now();

        AttendanceWindow::create([
            'day_id' => 4,
            'school_id' => $this->school_id,
            'name' => 'Default Schedule' . $currentDate->format('Y-m-d'),
            'total_present' => 0,
            'total_absent' => 0,
            'date' => $currentDate->format('Y-m-d'),
            'type' => 'default',
            'check_in_start_time' => $currentDate->copy()->setTime(7, 0)->format('Y-m-d H:i:s'),
            'check_in_end_time' => $currentDate->copy()->setTime(8, 0)->format('Y-m-d H:i:s'),
            'check_out_start_time' => $currentDate->copy()->setTime(16, 0)->format('Y-m-d H:i:s'),
            'check_out_end_time' => $currentDate->copy()->setTime(15, 0)->format('Y-m-d H:i:s'),
        ]);
    }

}
