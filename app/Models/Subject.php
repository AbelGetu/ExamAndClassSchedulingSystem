<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * Get all of the teacher_allocations for the Subject
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teacher_allocations()
    {
        return $this->hasMany(TeacherAllocation::class, 'subject_id');
    }
}
