<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    /**
     * Get all of the student_classes for the Semester
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function student_classes()
    {
        return $this->hasMany(StudentClass::class, 'semester_id');
    }
}
