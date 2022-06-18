<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSectionAllocation extends Model
{
    use HasFactory;

     /**
     * Get the section that owns the SectionAllocation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * Get the student_class that owns the SectionAllocation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student_class()
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }
}
