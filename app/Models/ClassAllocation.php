<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAllocation extends Model
{
    use HasFactory;


    /**
     * Get the student_class that owns the ClassAllocation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student_class()
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }

    /**
     * Get the room that owns the ClassAllocation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
