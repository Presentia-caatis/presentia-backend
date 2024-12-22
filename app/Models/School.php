<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_plan_id',
        'school_name',
        'address',
        'latest_subscription',
        'end_subscription',
    ];


    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function schoolFeatures()
    {
        return $this->hasMany(SchoolFeature::class);
    }

    public function subscriptionHistories()
    {
        return $this->hasMany(SubscriptionHistory::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function absencePermitTypes()
    {
        return $this->belongsToMany(AbsencePermitType::class, 'absence_permit_type_schools')
                    ->withTimestamps();
    }

    public function attendanceLateTypes()
    {
        return $this->belongsToMany(AttendanceLateType::class, 'attendance_late_type_schools')
                    ->withTimestamps();
    }
}
