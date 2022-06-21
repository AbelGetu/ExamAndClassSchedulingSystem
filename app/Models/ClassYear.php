<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassYear extends Model
{
    use HasFactory;

    /**
     * Get all of the student_classes for the ClassYear
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function student_classes()
    {
        return $this->hasMany(StudentClass::class, 'class_year_id');
    }
}
