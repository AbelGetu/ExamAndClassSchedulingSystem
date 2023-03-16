<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    /**
     * Get all of the class_section_allocations for the Section
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function class_section_allocations()
    {
        return $this->hasMany(ClassSectionAllocation::class, 'section_id');
    }
}
