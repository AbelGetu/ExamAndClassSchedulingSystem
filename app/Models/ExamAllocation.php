<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAllocation extends Model
{
    use HasFactory;

    /**
     * Get the student_class that owns the ExamAllocation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student_class()
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }

    /**
     * Get the subject that owns the ExamAllocation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
