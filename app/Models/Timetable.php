<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    /**
     * Get the teacher_allocation that owns the Timetable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher_allocation()
    {
        return $this->belongsTo(TeacherAllocation::class, 'teacher_allocation_id');
    }
}
