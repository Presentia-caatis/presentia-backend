<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsencePermitTypeSchool extends Model
{
    use HasFactory;

    protected $fillable = ['school_id', 'absence_permit_type_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function absencePermitType()
    {
        return $this->belongsTo(AbsencePermitType::class);
    }
}
