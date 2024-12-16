<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLateTypeSchool extends Model
{
    use HasFactory;

    protected $fillable = ['school_id', 'attendance_late_type_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function attendanceLateType()
    {
        return $this->belongsTo(AttendanceLateType::class);
    }   
}
