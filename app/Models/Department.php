<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * Get the college that owns the Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }

    /**
     * Get all of the student_classes for the Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function student_classes()
    {
        return $this->hasMany(StudentClass::class, 'department_id');
    }
}
