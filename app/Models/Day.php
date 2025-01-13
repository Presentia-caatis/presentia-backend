<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_schedule_id',
        'school_id'
    ];


    public function attendanceSchedule()
    {
        return $this->belongsTo(AttendanceSchedule::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
