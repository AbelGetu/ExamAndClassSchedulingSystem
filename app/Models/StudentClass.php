<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    /**
     * Get the class_year that owns the StudentClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class_year()
    {
        return $this->belongsTo(ClassYear::class, 'class_year_id');
    }

    /**
     * Get the academic_calendar  that owns the StudentClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function academic_calendar()
    {
        return $this->belongsTo(AcademicCalendar::class, 'academic_calendar_id');
    }

    /**
     * Get the semester that owns the StudentClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    /**
     * Get the Department that owns the StudentClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Get all of the class_section_allocation for the StudentClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function class_section_allocations()
    {
        return $this->hasMany(ClassSectionAllocation::class, 'student_class_id');
    }
}
