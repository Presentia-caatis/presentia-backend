<?php

namespace App\Models;

use App\BelongsToSchool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use BelongsToSchool;
    use HasFactory;

    protected $fillable = [
        'school_id',
        'id',
        'student_id',
        'check_in_status_id',
        'attendance_window_id',
        'check_in_time',
        'check_out_time',
    ];

    public function attendanceWindow()
    {
        return $this->belongsTo(AttendanceWindow::class);
    }

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
