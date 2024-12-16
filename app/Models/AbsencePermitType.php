<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsencePermitType extends Model
{
    use HasFactory;

    protected $fillable = [
        'permit_name',
        'active_status',
    ];

    public function absencePermits()
    {
        return $this->hasMany(AbsencePermit::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'absence_permit_type_schools')
                    ->withTimestamps();
    }
}
