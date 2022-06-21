<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    /**
     * Get the institute that owns the College
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }

    /**
     * Get all of the departments for the College
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments()
    {
        return $this->hasMany(Department::class, 'college_id');
    }
}
