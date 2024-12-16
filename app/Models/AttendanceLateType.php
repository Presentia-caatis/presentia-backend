<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLateType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
        'description',
        'active_status',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'attendance_late_type_schools')
                    ->withTimestamps();
    }
}
