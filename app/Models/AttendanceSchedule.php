<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceSchedule extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceScheduleFactory> */
    use HasFactory;


    protected $fillable = [
        'event_id',
        'name',
        'type',
        'check_in_start_time',
        'check_in_end_time',
        'check_out_start_time',
        'check_out_end_time'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function school()
    {
        return $this->$this->belongsToMany(school::class, 'days')
        ->withTimestamps();;
    }
}
