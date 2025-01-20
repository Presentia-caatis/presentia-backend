<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'id',
        'student_id',
        'attendance_late_type_id',
        'attendance_window_id',
        'check_in_time',
        'check_out_time',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function checkInStatus()
    {
        return $this->belongsTo(CheckInStatus::class);
    }

    public function absencePermits()
    {
        return $this->hasMany(AbsencePermit::class);
    }
}
