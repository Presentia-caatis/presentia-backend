<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceWindow extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceWindowFactory> */
    use HasFactory;

    

    protected $fillable = [
        'day_id',
        'name',
        'total_present',
        'total_absent',
        'type',
        'date',
        'check_in_start_time',
        'check_in_end_time',
        'check_out_start_time',
        'check_out_end_time'
    ];
}
