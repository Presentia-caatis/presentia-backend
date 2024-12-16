<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'class_name',
        'amount_of_students',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function school() {
        return $this->belongsTo(School::class);
    }
}
