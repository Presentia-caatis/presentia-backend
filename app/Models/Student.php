<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'class_group_id',
        'nis',
        'nisn',
        'student_name',
        'gender',
    ];

    public function classGroup()
    {
        return $this->belongsTo(ClassGroup::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function school() {
        return $this->belongsTo(School::class);
    }
}
